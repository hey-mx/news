<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function loginAction()
    {
        return $this->render('AppBundle:User:login.html.twig', array(
            // ...
        ));
    }

    public function signInAction()
    {
        return $this->render('AppBundle:User:sign_in.html.twig', array(
            // ...
        ));
    }

}
