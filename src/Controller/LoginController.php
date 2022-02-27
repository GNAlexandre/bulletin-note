<?php

namespace App\Controller;

use http\Client\Curl\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    /**
     * @Route("/", name="login")
     */
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
                // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();


        if ($this->isGranted('IS_AUTHENTICATED_FULLY')) {

            return $this->redirectToRoute('page_acceuil');//redirection pour symfony
        }

        return $this->render('login/index.html.twig', [
            'controller_name' => 'LoginControlleur',
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);


    }
}
