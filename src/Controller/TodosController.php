<?php

namespace App\Controller;

use App\Entity\Todo;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/todos')]
class TodosController extends AbstractController
{
    #[Route('/', name: 'todo.index')]
    public function index(ManagerRegistry $doctrine):Response
    {
        $respository = $doctrine->getRepository(Todo::class);
        $todos = $respository->findAll();
        return $this->render('todo/index.html.twig', ['todos' => $todos]);
    }
    #[Route('/add', name: 'todo.add')]
    public function addTodo(ManagerRegistry $doctrine): Response
    {
        $enttityManager = $doctrine->getManager();

        $todos = new Todo();
        $todos->setTache("Je dois acheter un telephone s20+");
        $todos->setAuthor("Abdoulaye");

        $todos2 = new Todo();
        $todos2->setTache("Je dois acheter un telephone s20+");
        $todos2->setAuthor("Abdoulaye");
        // Excution de la transaction
        $enttityManager->persist($todos);
        $enttityManager->persist($todos2);

        $enttityManager->flush(); // flush() équivaut à la function save de laravel.

        return $this->render('todos/index.html.twig', [
            'todos' => $todos
        ]);
    }


}
