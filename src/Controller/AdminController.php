<?php

namespace App\Controller;

use App\Repository\VisitorRequestRepository;
use App\Repository\VistorMessageRepository;
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
        
        $messages = $vistorMessageRepository->findAll();

        return $this->render('admin/index.html.twig', [
            "messages"      => $messages
        ]);
    }


}
