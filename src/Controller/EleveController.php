<?php

namespace App\Controller;

use App\Entity\Eleve;
use App\Entity\Matiere;
use App\Entity\Note;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class EleveController extends AbstractController
{
    /**
     * @Route("/eleve", name="eleve")
     */
    public function index(EntityManagerInterface $em,UserInterface $user): Response
    {


        $Prenom=array($em->getRepository(Eleve::class)->findOneBy(['nom' => $user->getUserIdentifier()]));
        //Recuperation des infos de l'eleve en fonction des informations d'identification

        //Trie des informations dans affichage
        $Affichage=[];
        $Affichage[0]= $Prenom[0]->getId();
        $Affichage[1]= $Prenom[0]->getNom();
        $Affichage[2]= $Prenom[0]->getIdClasseExt();
        $Affichage[3]= array($em->getRepository(Note::class)->findBy(['id_eleve_ext' => $Affichage[0]]));//recuperation de toute ces notes


        //recuperation du nom de la matiere pour chacune de ces notes
        $nb=0;
        $Affichage[4][0]=[];
        foreach ($Affichage[3][0] as $matiere){
            $Affichage[4][0][$nb]= $em->getRepository(Matiere::class)->findOneBy(['id' => $matiere->getIdMatiereExt()]);
            $nb++;
        }

        dump($Affichage);


        return $this->render('eleve/index.html.twig', [
            "Affichage"=>$Affichage
        ]);
    }
}
