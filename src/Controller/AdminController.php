<?php

namespace App\Controller;

use App\Entity\VistorMessage;
use App\Repository\VisitorRequestRepository;
use App\Repository\VistorMessageRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



/**
 * @isGranted("ROLE_USER")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(
        VistorMessageRepository $vistorMessageRepository
    ): Response
    {
        
        $messages = $vistorMessageRepository->findBy(["isArchived" => false]);

        return $this->render('admin/index.html.twig', [
            "visitorMessages"      => $messages,
            "isArchive"            => false
        ]);
    }

    /**
     * @Route("/admin/archived", name="admin_vmess_archived")
     */
    public function archivedMessage(
        VistorMessageRepository $vistorMessageRepository
    ): Response
    {

        $messages = $vistorMessageRepository->findBy(["isArchived" => true]);

        return $this->render('admin/index.html.twig', [
            "visitorMessages"      => $messages,
            "isArchive"            => true
        ]);
    }



    /**
     * @param VistorMessage $message
     * @param VistorMessageRepository $messageRepository
     * @return Response
     * @throws ORMException
     * @throws OptimisticLockException
     * @Route("/admin/visitor-message/{id}/delete", name="admin_vmess_delete")
     */
    public function deleteVisitorMessageAjax(
        VistorMessage $message,
        VistorMessageRepository $messageRepository
    ):Response
    {
        // Le repository supprime le message avec ->remove($message)
        $messageRepository->remove($message);

        // On renvoie une réponse au format JSON
        return $this->json([
            "status"    => "Effacé",
            "message"   => "Le message a été effacé!"
        ]);
    }



    /**
     * @param VistorMessage $message
     * @param VistorMessageRepository $messageRepository
     * @return Response
     * @throws ORMException
     * @throws OptimisticLockException
     * @Route("/admin/visitor-message/{id}/archive", name="admin_vmess_archive")
     */
    public function archiveVisitorMessageAjax(
        VistorMessage $message,
        VistorMessageRepository $messageRepository
    ):Response
    {
        $message->setIsArchived(true);
        // Le repository sauvegarde le message en base
        $messageRepository->add($message);

        // On renvoie une réponse au format JSON
        return $this->json([
            "status"    => "Archivé",
            "message"   => "Le message a été archivé!"
        ]);
    }


    /**
     * @param VistorMessage $message
     * @param VistorMessageRepository $messageRepository
     * @return Response
     * @throws ORMException
     * @throws OptimisticLockException
     * @Route("/admin/visitor-message/{id}/unarchive", name="admin_vmess_unarchive")
     */
    public function unarchiveVisitorMessageAjax(
        VistorMessage $message,
        VistorMessageRepository $messageRepository
    ):Response
    {
        $message->setIsArchived(false);
        // Le repository sauvegarde le message en base
        $messageRepository->add($message);

        // On renvoie une réponse au format JSON
        return $this->json([
            "status"    => "Désarchivé",
            "message"   => "Le message a été restoré!"
        ]);
    }


}
