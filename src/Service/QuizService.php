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

        foreach ($selectedVariantsSorted as $item) {
            $quiz->addAnswer(new Answer($item['question'], $item['selected_variants']));
        }

        return $quiz;
    }

    private function sortSelectedVariantsByQuestionId(array $selectedVariants): array
    {
        $selectedVariantsSorted = [];

        foreach ($selectedVariants as $selectedVariant) {
            $question = $selectedVariant->getQuestion();
            $questionId = $question->getId();

            if (!isset($selectedVariantsSorted[$questionId])) {
                $selectedVariantsSorted[$questionId] = [
                    'question' => $question,
                    'selected_variants' => [],
                ];
            }

            $selectedVariantsSorted[$questionId]['selected_variants'][] = $selectedVariant;
        }

        return $selectedVariantsSorted;
    }

    public function saveResult(Quiz $quiz): void
    {
        $this->entityManager->persist($quiz);
        $this->entityManager->flush();
    }
}