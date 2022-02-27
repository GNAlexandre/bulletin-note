<?php

namespace App\Controller;

use App\Entity\Enseignant;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegisterProfController extends AbstractController
{
    /**
     * @Route("/register_prof", name="app_register_prof")
     */
    public function addProjet(Request $request, EntityManagerInterface $entityManager): Response
    {

        //Récupération des données récupéré en POST
        $get = $request->request->all();

        //Est ce qu'il y a des nouvelles données à ajouter ?
        if(count($get)>0){
            //Ajout de mon entité
            $projet = new Enseignant();
            $projet->setName($get['name']);
            $projet->setId_Matiere($get['id_matiere']);
            $projet->setRole("Enseignant");
            $projet->setPassword("test");


            $entityManager->persist($projet); //prépare pour l'enregistrement dans la base de données

            $entityManager->flush(); //ça liquide tout, la chasse d'eau qwa
        }
        return $this->render('register_prof/index.html.twig');
    }
}
