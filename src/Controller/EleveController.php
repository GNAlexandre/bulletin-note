<?php

namespace App\Controller;

use App\Entity\Eleve;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EleveController extends AbstractController
{
    /**
     * @Route("/eleve", name="eleve")
     */
    public function index(EntityManagerInterface $em): Response
    {
        $Eleve=$em->getRepository(Eleve::class)->findAll();


        return $this->render('eleve/index.html.twig', [
            "Eleve"=>$Eleve
        ]);
    }
}
