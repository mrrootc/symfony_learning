<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class SessionController extends AbstractController
{
    #[Route('/session', name: 'session')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();
        if($session->has("nbrVisite")){
            $nbrVisite = $session->get('nbrVisite') +1;
        }
        else{
            $nbrVisite = 1;
        }
        $session->set('nbrVisite', $nbrVisite);
        return $this->render('session/index.html.twig');
    }
}
