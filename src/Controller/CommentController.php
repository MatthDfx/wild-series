<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    #[Route('/comment', name: 'app_comment')]
    public function index(): Response
    {
        return $this->render('comment/index.html.twig', [
            'controller_name' => 'CommentController',
        ]);
    }

    #[Route('/new', name: 'new')]
    public function new(): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        return $this->renderForm('comment/new.html.twig', [
            'form' => $form,
        ]);
    }
}
