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
    public function listeMessage()
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        return $this->render('signal/index.html.twig', []);
    }
}
