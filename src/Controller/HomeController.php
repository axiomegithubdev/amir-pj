<?php

namespace App\Controller;

use App\Entity\VistorMessage;
use App\Form\VisitorMessageType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(
        Request $request
    ): Response
    {
        $message = new VistorMessage();

        // On va spécifier une autre route pour la soumission du formualaire
        $form = $this->createForm( VisitorMessageType::class, $message, [
            "action" => $this->generateUrl("home_visitor_message_post")
        ] );


        return $this->render('home/index.html.twig', [
            "formMessage"      => $form->createView()
        ]);
    }

    /**
     * @Route("/jsontest-jojo", name="json_test")
     */
    public function jsonTest():Response
    {
        // $this->json est une méthode d'AbstractController qui permet de formater un Array en Json
        return $this->json([
            "message"   => "Vous êtes bien dans le controller TEST"
        ],
            Response::HTTP_OK
        );
    }


    /**
     * @Route("/jsontest2", name="json_test_2")
     */
    public function jsonTest2():Response
    {
        // $this->json est une méthode d'AbstractController qui permet de formater un Array en Json
        return $this->json([
            "message"   => "Vous êtes dans un autre controller"
        ],
            Response::HTTP_OK
        );
    }

    /**
     * @return void
     * @Route("/visitor-message/post", name="home_visitor_message_post", methods={"GET", "POST"})
     */
    public function postVisitorMessageAJAX(
        Request $request,
        EntityManagerInterface $manager
    ):Response
    {

        $message = new VistorMessage();

        // On va spécifier une autre route pour la soumission du formualaire
        $form = $this->createForm( VisitorMessageType::class, $message, [
            "action" => $this->generateUrl("home_visitor_message_post")
        ] );


        // SI le formulaire comporte le formulaire complété, il va mettre à jour la variable $message
        $form->handleRequest($request);

        // ON s'assure que le form est soumis et qu'il est valide
        if( $form->isSubmitted() && $form->isValid() ){
            $manager->persist($message);
            $manager->flush();

            // Renvoyer la réponse en JSON
            return $this->json([
                "message"   => "Votre message a bien été envoyé, Merci!"
            ],
                Response::HTTP_OK);
        }

        // Renvoyer la réponse en JSON
        return $this->json([
            "message"   => "Votre message n'a pas pu être envoyé!"
        ],
        Response::HTTP_BAD_REQUEST);
    }

}
