<?php
namespace AppBundle\Service;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoginForm
{
    protected $templating;
    protected $mailer;

    public function __construct(ContainerInterface $container)
    {
        $this->templating = $container->get('templating');
        $this->mailer = $container->get('mailer');
    }

    public function buildFields($form)
    {
        $form->add('email', EmailType::class)
            ->add('password', PasswordType::class);
    }

    public function sendActivation($user)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Welcome ' . $user->getFirstname())
            ->setFrom('isc.jcjl.android@gmail.com')
            ->setTo($user->getEmail())
            ->setBody($this->templating->render(
                'AppBundle:User:email_activation.html.twig', array(
                    'userid' => $user->getId(),
                    'username' => $user->getFirstname(),
                )
            ), 'text/html');
        $this->mailer->send($message);
    }
}