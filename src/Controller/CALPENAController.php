<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Utilisateurs;

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
    public function loginconfirm(request $request, EntityManagerInterface $manager): Response
    {   
        $Login = $request -> request -> get("Login");
        $password = $request -> request -> get("Password");
        $reponse = $manager -> getRepository(Utilisateurs :: class) -> findOneBy([ 'Login' => $Login]);
        if ($reponse == NULL){
            $repons ="L'utilisateur est pas connu de la base de données";
             } 
        else{
             $code = $reponse -> getPassword();
             if (password_verify($password,$code)){
                 $repons = "Acces autorisé";
             }else {
                $repons = "Acces non autorisé, le mdp n'est pas valide";
             }
             
             }
        return $this->render('calpena/loginconfirm.html.twig', [
            'Message' => $repons,
            'Login' => $Login,
        ]);
    }

    /**
     * @Route("/calpena/formulaireUsers", name="formUsers")
     */
    public function formuser(): Response
    {
     

        return $this->render('calpena/formulaireUsers.html.twig', [
            'controller_name' => 'CALPENAController',
        ]);
    }

     /**
     * @Route("/calpena/AddUsers", name="Addusers")
     */
    public function adduser(Request $request,EntityManagerInterface $manager): Response
    {
        $Login = $request -> request -> get("Login");
        $Password = $request -> request -> get("Password");
        $Password = (password_hash($Password, PASSWORD_DEFAULT));
        $monUtilisateurs = new Utilisateurs();
        $monUtilisateurs -> setLogin($Login);
        $monUtilisateurs -> setPassword($Password);
        $manager -> persist($monUtilisateurs);
        $manager -> flush();

        return $this->redirectToRoute ('formUsers');
    }
}