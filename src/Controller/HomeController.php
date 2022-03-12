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
        Request $request,
        EntityManagerInterface $manager
    ): Response
    {
        $message = new VistorMessage();
        $form = $this->createForm( VisitorMessageType::class, $message );


        // SI le formulaire comporte le formulaire complété, il va mettre à jour la variable $message
        $form->handleRequest($request);

        // ON s'assure que le form est soumis et qu'il est valide
        if( $form->isSubmitted() && $form->isValid() ){
            $manager->persist($message);
            $manager->flush();
            return $this->redirectToRoute("home");
        }

        return $this->render('home/index.html.twig', [
            "formMessage"      => $form->createView()
        ]);
    }


    

}
