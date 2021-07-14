<?php

namespace App\Controller;

use App\Repository\MessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SignalController extends AbstractController
{
    /**
     * @Route("/", name="signal")
     */
    // Fonction permettant de lister les messages
    public function listeMessage()
    {
        //Il faut etre connecter en tant qu'utilisateur
        $this->denyAccessUnlessGranted('ROLE_USER');

        //redirige vers la page d'acceuil
        return $this->render('signal/index.html.twig', []);
    }
}
