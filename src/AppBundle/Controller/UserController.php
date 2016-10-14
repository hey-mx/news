<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\UserType;
use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Symfony\Component\HttpFoundation\Session\Session;

class UserController extends Controller
{
    public function loginAction(Request $request)
    {
        $data = array();
        $form = $this->createFormBuilder($data)->getForm();
        $loginFormDecorator = $this->get('app.login_form');
        $loginFormDecorator->buildFields($form);
        $form->handleRequest($request);
        $error = '';
        if ($request->isMethod('POST') && $form->isValid()) {
            $data = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository('AppBundle:User')->findOneBy(array(
                'email' => $data['email'],
                'status' => 1
            ));
            if (is_object($user)) {
                $encoder = new MessageDigestPasswordEncoder('sha1');
                $password = $encoder->encodePassword($data['password'],
                $user->getSalt());
                if ($password == $user->getPassword()) {
                    $session = new Session();
                    $session->set('user', $user->getId());
                    return $this->redirectToRoute('home');
                }
            }
                $error = 'Bad credentials, user or password not match';
        }
        return $this->render('AppBundle:User:login.html.twig', array(
            'form' => $form->createView(),
            'error' => $error
        ));
    }

    public function signInAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        $error = '';
        if ($form->isSubmitted() && $form->isValid()) {
            $encoder = new MessageDigestPasswordEncoder('sha1');
            $password = $encoder->encodePassword($user->getPassword(),
                $user->getSalt());
            try {
                $user->setPassword($password);
                $user->setStatus(1);
                $user->setCreateat(new \DateTime('now'));
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
                $loginHelper = $this->get('app.login_form');
                $loginHelper->sendActivation($user);
                $session = new Session();
                $session->set('user', $user->getId());
                return $this->redirectToRoute('home');
            } catch(\Exception $e) {
                //$error = 'The email is alredy in use. Please try with another one';
                $error = $e->getMessage();
            }
        }
        return $this->render('AppBundle:User:sign_in.html.twig', array(
            'form' => $form->createView(),
            'error' => $error,
        ));
    }

    public function verifyAction($userid)
    {
        $em = $this->getDoctrine()->getManager();
        $message = 'Invalid account';
        $user = $em->getRepository('AppBundle:User')->findOneBy(array(
            'id' => $userid,
            'status' => 1
        ));
        if (is_object($user) && empty($user->getVerifiedat())) {
            $user->setVerifiedat(new \DateTime('now'));
            $em->persist($user);
            $em->flush();
            $message = 'Now you are able to publish content';
            $session = new Session();
            $session->set('user', $user->getId());
        } elseif (!empty($user->getVerifiedat())) {
            $message = 'Your account is alredy verified';
        }
        return $this->redirectToRoute('home', array(
            'message' => $message,
        ));
    }
}
