<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageAcceuilController extends AbstractController
{
    /**
     * @Route("/page_acceuil", name="page_acceuil")
     */
    public function index(): Response
    {
        return $this->render('page_acceuil/index.html.twig', [
            'controller_name' => 'PageAcceuilController',
        ]);
    }
}
