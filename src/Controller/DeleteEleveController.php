<?php

namespace App\Controller;

use App\Entity\Appartenir;
use App\Entity\Eleve;
use App\Entity\Enseignant;
use App\Entity\Matiere;
use App\Entity\Note;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeleteEleveController extends AbstractController
{
    /**
     * @Route("/delete_eleve/{id}", name="delete_eleve")
     */
    public function index(EntityManagerInterface $em,int $id,ManagerRegistry $doctrine): Response
    {

        //fonction de suppression de l'eleve ainsi que ces notes identique à la précédente de professeur
        $em = $doctrine->getManager();
        $Login[0]=null;

        $enseignant=$em->getRepository(Eleve::class)->findOneBy(['id'=>$id]);//recuperation eleve
        $appartenir=$em->getRepository(Note::class)->findBy(['id_eleve_ext'=>$enseignant->getId()]);//recuperation note
        dump($enseignant);
        dump($appartenir);

        $em->remove($enseignant);
        $em->flush();

        foreach ($appartenir as $lienClasse){
            $em->remove($lienClasse);
            $em->flush();
        }


        return $this->render('page_acceuil/index.html.twig',['Login'=>$Login]);
    }
}
