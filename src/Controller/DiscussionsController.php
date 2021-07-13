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
    public function listeGroup(GroupRepository $groupRepository): JsonResponse
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $user = $this->getUser();
        $groupes = $groupRepository->findGroupByMessage($user->getId());
        return new JsonResponse(['groups' => $groupes]);
    }

    /*
     * Attention : URL utilisée dans le fichier slack.js, function listerGroup()
     */
    /**
     * @Route("/messages/ajax/{group}", name="message_ajax")
     */
    public function listeMessageByGroupe(MessageRepository $messageRepository, int $group): JsonResponse
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $messages = $messageRepository->findAllMessagesByGroup($group);
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
        return new JsonResponse(['data' => $messageArray]);
    }
}
