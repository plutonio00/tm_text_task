<?php

namespace App\Controller;

use App\Repository\QuestionRepository;
use JsonException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @throws JsonException
     */
    #[Route(path: '/quiz/process', name: 'quiz_process', methods: ['POST'])]
    public function processQuiz(Request $request): Response
    {
       $data = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
       dd($data);
       return new JsonResponse([]);
    }
}