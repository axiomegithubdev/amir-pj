<?php

namespace App\Controller;

use App\Repository\VisitorRequestRepository;
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
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }


    /**
     * @Route("/admin/visitor/requests", name="admin_visitor_requests")
     */
    public function visitorRequests(
        VisitorRequestRepository $repo
    ){
        $messages = $repo->findAll();


        return $this->render('admin/visitor_requests.html.twig', [
            "visitorMessages"  => $messages,
            "lastMessage"      => $repo->findOneBy([], [ "id" => "DESC"]),
            "messagesOfTheDay" => $repo->findMessagesOfTheDay()
        ]);
    }

}
