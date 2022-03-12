<?php

namespace App\Controller;

use App\Entity\Eleve;
use App\Entity\Note;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeleteUserController extends AbstractController
{
    /**
     * @Route("/delete_user/{id}", name="delete_user")
     */
    public function index(EntityManagerInterface $em,int $id,ManagerRegistry $doctrine): Response
    {
        //fonction suppression user

        $em = $doctrine->getManager();
        $Login[0]=null;

        $User=$em->getRepository(User::class)->findOneBy(['id'=>$id]);
        $em->remove($User);
        $em->flush();



        return $this->render('page_acceuil/index.html.twig',['Login'=>$Login]);
    }
}
