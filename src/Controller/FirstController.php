<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{
    #[Route('/first', name: 'app_first')]
    public function index(): Response
    {
        return $this->render('first/index.html.twig', [
            'controller_name' => 'FirstController',
        ]);
    }

    #[Route('sayHello/{firstname}/', name: "sayHello")]
    public function direBonjour($firstname):Response
    {
        return $this->render('sayHello.html.twig',
        [
            'firstname' => $firstname
        ]);
    }
}