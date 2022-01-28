<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CALPENAController extends AbstractController
{
    /**
     * @Route("/calpena", name="calpena")
     */
    public function index(): Response
    {
        return $this->render('calpena/index.html.twig', [
            'controller_name' => 'CALPENAController',
        ]);
    }
    /**
     * @Route("/calpena/loginconfirm", name="loginconfirm")
     */
    public function loginconfirm(): Response
    {
        return $this->render('calpena/loginconfirm.html.twig', [
            'controller_name' => 'CALPENAController',
        ]);
    }
}
