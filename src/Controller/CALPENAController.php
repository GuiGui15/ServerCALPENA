<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

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
    public function loginconfirm(request $request): Response
    {   
        $Login = $request -> request -> get("Login");
        $password = $request -> request -> get("Password");
        if (($Login=="root") && ($password=="toor")){
            $reponse = "acces autorise";
             } 
             else{
                 $reponse = "erreur";
             }
        return $this->render('calpena/loginconfirm.html.twig', [
            'Message' => $reponse,
        ]);
    }
}
