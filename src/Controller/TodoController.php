<?php

namespace App\Controller;

use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('todo')]
class TodoController extends AbstractController
{
    #[Route('/', name: 'todo')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();

        if(!$session->has('todos')){
            $tache = [
                'achat' => 'Je dois acheter un samsung Galaxy S20+ d\'ici le mois de janvier',
                'techno' => 'je dois maitriser le framework symfony dans 3 semaines max'
            ];
            $session->set('todos',$tache);
        }
        return $this->render('todo/index.html.twig');
        $this->addFlash('info', 'La liste des todos viens d\'etre initialise');
    }
    #[Route('/add/{name}/{content}', name: 'add_todo')]
    public function addTodo(Request $request,$name, $content):RedirectResponse
    {
        $session = $request->getSession();
        $todos = $session->get('todos');
        if($session->has('todos')){
            if(isset($todos[$name])){
                $this->addFlash('error', 'la todo existe deja');
            }else{
                $todos[$name] = $content;
                $this->addFlash('succes', "Todo $name ajouté avec succes");
                $session->set('todos', $todos);
            }
        }else{
            $this->addFlash('error', 'La liste des todos n\'est pas encore d\'etre initialise');
        }
        return $this->redirectToRoute('todo');
    }
    #[Route('update/{name}/{content}', name:"update")]
    public function updateTodo(Request $request, $name, $content):RedirectResponse
    {
       $session = $request->getSession();
       if($session->has('todos')){
           $todos = $session->get('todos');
           if(isset($todos[$name])){
               $todos[$name] = $content;
               $session->set('todos', $todos);
               $this->addFlash('succes', 'Todo modifier avec succes');
           }
           else{
               $this->addTodo('error', 'la cle de la todo n existe pas');
           }
       }
       return $this->redirectToRoute('todo');
    }
    #[Route('/delete/{name}', name: 'delele_todo')]
    public function deleteTodo(Request $request, $name):RedirectResponse
    {
        $session = $request->getSession();
        if($session->has('todos')){
            $todos = $session->get('todos');
            if(isset($todos[$name])){
               unset($todos[$name]);
               $this->addFlash('succes', 'todo supprimé avec success');
            }
            $session->set('todos', $todos);
        }
        return $this->redirectToRoute('todo');
    }
    #[Route('/reset', name:'reset')]
    public function resetTodo(Request $request):RedirectResponse
    {
        $session = $request->getSession();
        $session->remove('todos');
        return $this->redirectToRoute('todo');
    }
}
