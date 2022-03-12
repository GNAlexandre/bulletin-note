<?php

namespace App\Controller;

use App\Entity\Appartenir;
use App\Entity\Enseignant;
use Doctrine\ORM\EntityManagerInterface;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeleteController extends AbstractController
{
    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function index(EntityManagerInterface $em,int $id,ManagerRegistry $doctrine): Response
    {
        //Controller pour delete un professeur et son lien avec la classe

        $em = $doctrine->getManager();
        $Login[0]=null;

        $enseignant=$em->getRepository(Enseignant::class)->findOneBy(['id'=>$id]);//recuperation de l'enseignant
        $appartenir=$em->getRepository(Appartenir::class)->findBy(['id_enseignant_ext'=>$enseignant->getId()]);//recuperation du lien entre enseignant et classe
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
