<?php

namespace App\Controller;

use App\Entity\Eleve;
use App\Entity\Enseignant;
use App\Entity\Matiere;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Routing\Annotation\Route;

class PageAcceuilController extends AbstractController
{
    /**
     * @Route("/page_acceuil", name="page_acceuil")
     */
    public function index(EntityManagerInterface $em, UserInterface $user): Response
    {
        $Login=array($em->getRepository(Enseignant::class)->findOneBy(['name' => $user->getUserIdentifier()]));
        //On arrive à stocker ici les informations de l'enseignant trouver à partir de son identification login
        dump($Login);
        //$matiere=($em->getRepository(Matiere::class)->findOneBy(['id' => $Login[0][Id_Matiere]]));
        //$Login[0]->id_matiere =$matiere;

        if ($Login[0] == null){ //si il n'y a pas d'enseignant dans login alors c forcement un eleve donc on recherche par rapport au nom
                                // et non il n'y peu pas avoir 2 personne eleve comme professeur avec le meme nom
            $Login=array($em->getRepository(Eleve::class)->findOneBy(['nom' => $user->getUserIdentifier()]));
        }



        return $this->render('page_acceuil/index.html.twig', [
            "Login"=>$Login,
        ]);
    }
}
