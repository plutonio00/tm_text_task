<?php

namespace App\Service;

use App\DTO\QuizDTO;
use App\Entity\Answer;
use App\Entity\Quiz;
use App\Repository\AnswerVariantRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

class QuizService
{
    public function __construct(
        private readonly AnswerVariantRepository $answerVariantRepository,
        private readonly EntityManagerInterface  $entityManager,
    )
    {
    }

    public function getQuizResult(array $selectedVariantsIds): Quiz
    {
        $selectedVariants = $this->answerVariantRepository->findBy(['id' => $selectedVariantsIds]);
        $selectedVariantsSorted = $this->sortSelectedVariantsByQuestionId($selectedVariants);
        return $this->processAnswers($selectedVariantsSorted);
    }

    private function processAnswers(array $selectedVariantsSorted): Quiz
    {
        $quiz = new Quiz(new DateTime());

        foreach ($selectedVariantsSorted as $selectedVariants) {
            $isRight = true;
            $question = null;

            foreach ($selectedVariants as $selectedVariant) {
                $isRight = $isRight && $selectedVariant->isCorrect();

                if (!$question) {
                    $question = $selectedVariant->getQuestion();
                }
            }

            $quiz->addAnswer(new Answer($isRight, $question, $selectedVariants, $quiz));
        }

        return $quiz;
    }

    private function sortSelectedVariantsByQuestionId(array $answersVariants): array
    {
        $answersVariantsList = [];

        foreach ($answersVariants as $answerVariant) {
            $questionId = $answerVariant->getQuestion()->getId();

            if (!isset($answersVariantsList[$questionId])) {
                $answersVariantsList[$questionId] = [];
            }

            $answersVariantsList[$questionId][] = $answerVariant;
        }

        return $answersVariantsList;
    }

    public function saveResult(Quiz $quiz): void
    {
        $this->entityManager->persist($quiz);
        $this->entityManager->flush();
    }
}