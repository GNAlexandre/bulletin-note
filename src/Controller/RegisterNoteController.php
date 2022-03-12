<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Entity\Eleve;
use App\Entity\Enseignant;
use App\Entity\Matiere;
use App\Entity\Note;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class RegisterNoteController extends AbstractController
{
    /**
     * @Route("/register_note/{id}", name="register_note")
     */
    public function index(EntityManagerInterface $em,int $id,Request $request,UserInterface $user): Response
    {
        //Recuperation des eleves dans la classe
        $Classe=$em->getRepository(Eleve::class)->findBy(['id_classe_ext' => $id]);
        dump($Classe);

        //Recuperation des infos du professeur pour l'ajout de la note en fonction de la matiere du prof
        $Login=$em->getRepository(Enseignant::class)->findOneBy(['name' => $user->getUserIdentifier()]);
        dump($Login);


        //Récupération des données récupéré en POST
        $get = $request->request->all();

        //Est ce qu'il y a des nouvelles données à ajouter ?
        if(count($get)>0){

            foreach ($get as $eleve=>$note){
                $idd = explode("_",$eleve);
                if ($idd[0]=="Note" and $note!=null){ // eviter l'ajout d'information null
                    dump($idd[1]);// id de l'élève
                    dump($note);// note
                    $today = new \DateTime();// date

                    $Projet = new Note(); // créattion d'une nouvelle note pour un eleve
                    $Projet->setNote($note);
                    $Projet->setIdEleveExt($idd[1]);
                    $Projet->setIdMatiereExt($Login->getId_Matiere());
                    $Projet->setDateControle($today);

                    $em->persist($Projet); //prépare pour l'enregistrement dans la base de données
                    $em->flush(); //ça liquide tout, la chasse d'eau qwa
                }

            }

        }





        return $this->render('register_note/index.html.twig', [
            "Classe"=>$Classe,
            "id"=>$id
        ]);
    }
}
