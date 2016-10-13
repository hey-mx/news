<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\UserType;
use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    public function loginAction(Request $request)
    {
        $data = array();
        $form = $this->createFormBuilder($data);
        $loginFormDecorator = $this->get('app.login_form');
        $loginFormDecorator->buildFields($form);
        return $this->render('AppBundle:User:login.html.twig', array(
            // ...
        ));
    }

    public function signInAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            $user->setStatus(1);
            $user->setCreateat(new \DateTime('now'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('AppBundle:User:sign_in.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}
