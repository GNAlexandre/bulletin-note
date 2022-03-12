<?php

namespace App\Controller;

use App\Entity\Appartenir;
use App\Entity\Enseignant;
use App\Entity\Matiere;
use App\Entity\Note;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EnseignantController extends AbstractController
{
    /**
     * @Route("/enseignant", name="enseignant")
     */
    public function index(EntityManagerInterface $em,Request $request): Response
    {   //recuperation de tout les enseignants pour afficher une liste des enseignants déjà crée avec leurs matieres
        $Enseignants[0]=$em->getRepository(Enseignant::class)->findAll();


        //recuperation des informations supplémentaire pour l'enseignant tel que la matiere ou ces classes
        $nb=0;
        $Enseignants[1]=[];
        foreach ($Enseignants[0] as $enseignant){
            $Enseignants[1][$nb]= $em->getRepository(Matiere::class)->findOneBy(['id' => $enseignant->getId_Matiere()]);
            $Enseignants[2][$nb]= $em->getRepository(Appartenir::class)->findBy(['id_enseignant_ext' => $enseignant->getId()]);
            $nb++;
        }
        dump($Enseignants);



        //Formulaire qui affiche une liste des enseignants avec un formulaire et qui permet de les ajouter à une classe
        $get = $request->request->all();
        if(count($get)>0){
            dump($get);

            foreach ($get as $eleve=>$classe){
                $idd = explode("_",$eleve);
                if ($idd[0]=="Enseignant" and $classe!=null){ // permet de ne pas entrer des informations null

                    dump($idd[1]);// id de l'enseignant'
                    dump($classe);// id de la classe


                    $Projet = new Appartenir(); // création du lien dans la table appartenir
                    $Projet->setIdClasseExt(intval($classe));
                    $Projet->setIdEnseignantExt($idd[1]);


                    $em->persist($Projet); //prépare pour l'enregistrement dans la base de données
                    $em->flush(); //ça liquide tout, la chasse d'eau qwa
                }

            }

        }


        return $this->render('enseignant/index.html.twig', [
            "Enseignants"=>$Enseignants
        ]);
    }

}
