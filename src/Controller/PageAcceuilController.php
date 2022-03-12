<?php

namespace App\Controller;

use App\Entity\Appartenir;
use App\Entity\Classe;
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
        $Classe=[];//Initialisation de la variable Classe


        if ($Login[0] == null){ //si il n'y a pas d'enseignant dans login alors c forcement un eleve donc on recherche par rapport au nom
                                // et non il n'y peu pas avoir 2 personne eleve comme professeur avec le meme nom
            $Login=array($em->getRepository(Eleve::class)->findOneBy(['nom' => $user->getUserIdentifier()]));
        }
        else{
            $Login[1]=$em->getRepository(Matiere::class)->findOneBy(['id' => $Login[0]->getId()]);
            $Classe[0] = $em->getRepository(Appartenir::class)->findBy(['id_enseignant_ext' => $Login[0]->getId()]);//liste des liens dans la classe appartenir de notre enseignant

            $nb=0;
            $Classe[1]=[];
            foreach ($Classe[0] as $classe){
                $Classe[1][$nb]= $em->getRepository(Classe::class)->findOneBy(['id' => $classe->getIdClasseExt()]);//liste des classes auquels appartient l'enseignant
                $nb++;
            }
            dump($Classe);

        }
        dump($Login);


        return $this->render('page_acceuil/index.html.twig', [
            "Login"=>$Login,
            "Classe"=>$Classe
        ]);
    }
}
