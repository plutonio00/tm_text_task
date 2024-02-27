<?php

namespace App\Controller;

use App\Repository\QuestionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuizController extends AbstractController
{
    #[Route(path: '/', name: 'quiz_index', methods: ['GET'])]
    public function index(QuestionRepository $repository): Response
    {
        $questions = $repository->findAll();
        shuffle($questions);
        return $this->render('quiz/index.html.twig', [
            'questions' => $questions,
        ]);
    }
}