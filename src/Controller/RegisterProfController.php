<?php

namespace App\Controller;

use App\Entity\Appartenir;
use App\Entity\Enseignant;
use App\Entity\Matiere;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegisterProfController extends AbstractController
{
    /**
     * @Route("/register_prof", name="app_register_prof")
     */
    public function addProjet(Request $request, EntityManagerInterface $em): Response
    {
        //recuperation de la liste des professeurs et leurs matieres pour faire une liste de suppression
        $Enseignants[0]=$em->getRepository(Enseignant::class)->findAll();
        $nb=0;
        $Enseignants[1]=[];
        foreach ($Enseignants[0] as $enseignant){
            $Enseignants[1][$nb]= $em->getRepository(Matiere::class)->findOneBy(['id' => $enseignant->getId_Matiere()]);
            $nb++;
        }

        //Récupération des données récupéré en POST
        $get = $request->request->all();

        //Est ce qu'il y a des nouvelles données à ajouter ?
        if(count($get)>0){
            //Recherche si la matière existe déjà et sinon la crée
            $matiere = $em->getRepository(Matiere::class)->findOneBy(['name_matiere' => $get['nom_matiere']]);
            if($matiere==null){
                $new_matiere= new Matiere();
                $new_matiere->setNameMatiere($get['nom_matiere']);
                $new_matiere->setHeureDeCours(18);
                $em->persist($new_matiere); //prépare pour l'enregistrement dans la base de données
                $em->flush(); //ça liquide tout, la chasse d'eau qwa


            }
            $info[0]=$em->getRepository(Matiere::class)->findOneBy(['name_matiere' => $get['nom_matiere']]);


            //Ajout de mon entité
            $projet = new Enseignant();
            $projet->setName($get['name']);
            $projet->setId_Matiere($info[0]->getId());
            $projet->setRole("Enseignant");//Role important pour l'affichage de la page d'accceuil
            $projet->setPassword("test");//aucune utilité car le login ce fait grâce à une nouvelle table implementer grace à symfony mais déjà prévue au départ

            $em->persist($projet); //prépare pour l'enregistrement dans la base de données
            $em->flush(); //ça liquide tout, la chasse d'eau qwa


            $info[1]=$em->getRepository(Enseignant::class)->findOneBy(['name' => $get['name']]);


            dump($info);





        }
        return $this->render('register_prof/index.html.twig',[
            "Enseignants"=>$Enseignants
        ]);
    }
}
