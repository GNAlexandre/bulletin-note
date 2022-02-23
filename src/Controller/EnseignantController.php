<?php

namespace App\Controller;

use App\Entity\Enseignant;
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
        $Enseignants=$em->getRepository(Enseignant::class)->findAll();


        return $this->render('enseignant/index.html.twig', [
            "Enseignants"=>$Enseignants
        ]);
    }

}
