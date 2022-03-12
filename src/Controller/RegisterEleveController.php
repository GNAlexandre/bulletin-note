<?php

namespace App\Controller;

use App\Entity\Eleve;
use App\Entity\Enseignant;
use App\Entity\Matiere;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegisterEleveController extends AbstractController
{
    /**
     * @Route("/register_eleve", name="register_eleve")
     */
    public function addProjet(Request $request, EntityManagerInterface $em): Response
    {
        //Recuperation de la liste complete des eleves pour pouvoir les supprimers en dessous du form
        $Eleve=$em->getRepository(Eleve::class)->findAll();
        dump($Eleve);


        //Récupération des données récupéré en POST
        $get = $request->request->all();

        //Est ce qu'il y a des nouvelles données à ajouter ?
        if (count($get) > 0) {
            //Ajout de mon entité
            $projet = new Eleve();

            $projet->setNom($get['prenom']); // j'inverse express ici car c le cas dans la base de donnée sachant que l'identification se fait à partir du prenom qu'on considere unique
            $projet->setPrenom($get['nom']);
            $projet->setRole("Eleve");
            $projet->setPassword("test");
            $projet->setIdClasseExt($get['id_classe_ext']);



            $em->persist($projet); //prépare pour l'enregistrement dans la base de données

            $em->flush(); //ça liquide tout, la chasse d'eau qwa
        }
        return $this->render('register_eleve/index.html.twig',[
            "Eleve"=>$Eleve
        ]);
    }
}
