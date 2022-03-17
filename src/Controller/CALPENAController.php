<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Utilisateurs;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

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
    public function loginconfirm(request $request, EntityManagerInterface $manager, SessionInterface $session): Response
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
                $session->set('nomVar', $reponse->getId());
                return $this->redirectToRoute ('calpena/session');
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

    /**
     * @Route("/calpena/table", name="table")
     */
    public function afficheuser(Request $request,EntityManagerInterface $manager, SessionInterface $session): Response
    {
        $vs=$session -> get('nomVar');
        if ($vs!=0){
            $mesUtilisateurs=$manager->getRepository(Utilisateurs::class)->findAll();
            return $this->render('/calpena/table.html.twig',['lst_utilisateurs' => $mesUtilisateurs]);
        }else{
            return $this->render('calpena/index.html.twig', [
                'controller_name' => 'CALPENAController',
            ]);
        }
       
        
    }

    
/**
* @Route("/supprimerUtilisateur/{id}",name="supprimer_Utilisateur")
*/
public function supprimerUtilisateur(EntityManagerInterface $manager,Utilisateurs $editutil): Response {
    $manager->remove($editutil);
    $manager->flush();
    // Affiche de nouveau la liste des utilisateurs
    return $this->redirectToRoute ('table');
 }
 

    /**
     * @Route("/calpena/session", name="calpena/session")
     */
    public function session(SessionInterface $session, EntityManagerInterface $manager): Response
    {
        $vs = $session -> get('nomVar');
        $user=$manager->getRepository(Utilisateurs::class)->findOneById($vs);
        return $this->render('calpena/session.html.twig',['name' => $user->getLogin()]);
}

/**
     * @Route("/calpena/deco", name="calpena/deco")
     */
    public function deco(SessionInterface $session): Response
    {
        $session->clear();
        return $this->render('calpena/index.html.twig', [
            'controller_name' => 'CALPENAController',
        ]);
        
}

}

