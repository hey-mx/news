<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $message = $request->query->get('message');
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:Article');
        $query = $repository->createQueryBuilder('a')
            ->where('a.status > 1')
            ->orderBy('a.createdat', 'DESC')
            ->getQuery();
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1)
        );
        return $this->render('AppBundle:Default:home.html.twig', array(
            'pagination' => $pagination,
            'message' => $message,
        ));
    }
}
