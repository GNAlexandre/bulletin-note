<?php

namespace App\Controller;

use App\Entity\Enseignant;
use App\Entity\Matiere;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EnseignantController extends AbstractController
{
    /**
     * @Route("/enseignant", name="enseignant")
     */
    public function index(EntityManagerInterface $em): Response
    {
        $Enseignants[0]=$em->getRepository(Enseignant::class)->findAll();
        $nb=0;
        $Enseignants[1]=[];
        foreach ($Enseignants[0] as $enseignant){
            $Enseignants[1][$nb]= $em->getRepository(Matiere::class)->findOneBy(['id' => $enseignant->getId_Matiere()]);
            $nb++;
        }
        dump($Enseignants);


        return $this->render('enseignant/index.html.twig', [
            "Enseignants"=>$Enseignants
        ]);
    }

}
