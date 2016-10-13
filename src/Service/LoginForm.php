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
}