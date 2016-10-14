<?php
namespace AppBundle\Service;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class LoginForm
{
    public function buildFields($form)
    {
        $form->add('email', EmailType::class)
            ->add('password', PasswordType::class);
    }

    public function sendActivation($user, $view, $mailClient)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Welcome ' . $user->getFirstname())
            ->setFrom('isc.jcjl.android@gmail.com')
            ->setTo($user->getEmail())
            ->setBody($view, 'text/html');
        $mailClient->send($message);
    }
}