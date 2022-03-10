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
        $Eleve=$em->getRepository(Eleve::class)->findAll();

        $Prenom=array($em->getRepository(Eleve::class)->findOneBy(['nom' => $user->getUserIdentifier()]));

        //Recuperation et organisation des informations qui m'interesse
        $Affichage=[];
        $Affichage[0]= $Prenom[0]->getId();
        $Affichage[1]= $Prenom[0]->getNom();
        $Affichage[2]= $Prenom[0]->getIdClasseExt();
        $Affichage[3]= array($em->getRepository(Note::class)->findBy(['id_eleve_ext' => $Affichage[0]]));
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
