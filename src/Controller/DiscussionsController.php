<?php

namespace App\Controller;

use App\Repository\GroupRepository;
use App\Repository\MessageRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DiscussionsController extends AbstractController
{
    /**
     * @Route("/groupes/ajax", name="groupes_ajax")
     */
    //Pemret de lister les groupes de l'utilisateur connecter
    public function listeGroup(GroupRepository $groupRepository): JsonResponse
    {
        //Il faut etre connecter en utilisateur
        $this->denyAccessUnlessGranted('ROLE_USER');
        //On recupere l'utilisateur
        $user = $this->getUser();
        //On recupere les groupes de cet utilisateur
        $groupes = $groupRepository->findGroupByMessage($user->getId());
        //Renvoi sous forme d'un Json
        return new JsonResponse(['groups' => $groupes]);
    }

    /*
     * Attention : URL utilisée dans le fichier slack.js, function listerGroup()
     */
    /**
     * @Route("/messages/ajax/{group}", name="message_ajax")
     */
    //renvoi les messages d'un groupe
    public function listeMessageByGroupe(MessageRepository $messageRepository, int $group): JsonResponse
    {
        //Il faut etre connecter en utilisateur
        $this->denyAccessUnlessGranted('ROLE_USER');
        //On recupere les messages d'un groupes
        $messages = $messageRepository->findAllMessagesByGroup($group);

        //Nous traitons la donnée pour l'inserer dans un tableau
        $messageArray = [];
        for ($i=0; $i<count($messages); $i++)
        {
            $messageArray[$i]['id']=$messages[$i]->getId();
            $messageArray[$i]['text']=$messages[$i]->getText();
            $messageArray[$i]['dateCreate']= $messages[$i]->getDateCreate()->format('d/m/Y');
            $messageArray[$i]['dateCreateHeure']= $messages[$i]->getDateCreate()->format('H:i');
            $messageArray[$i]['idGroup']=$messages[$i]->getIdGroup()->getId();
            $messageArray[$i]['idGroup']=$messages[$i]->getIdGroup()->getName();
            $messageArray[$i]['idMember']=$messages[$i]->getIdMember()->getId();
            $messageArray[$i]['idMember']=$messages[$i]->getIdMember()->getPseudo();
        }
        //Ce tableau est renvoyer sous format Json
        return new JsonResponse(['data' => $messageArray]);
    }

    public function EcrireMessage($UnMessage)
    {

    }
}
