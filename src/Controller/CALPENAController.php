<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CALPENAController extends AbstractController
{
    /**
     * @Route("/c/a/l/p/e/n/a", name="c_a_l_p_e_n_a")
     */
    public function index(): Response
    {
        return $this->render('calpena/index.html.twig', [
            'controller_name' => 'CALPENAController',
        ]);
    }
}
