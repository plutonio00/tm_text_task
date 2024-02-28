<?php

namespace App\Service;

use App\DTO\QuizDTO;
use App\Entity\QuizResult;
use App\Repository\AnswerRepository;
use Doctrine\ORM\EntityManagerInterface;

class QuizService
{
    public function __construct(
        private readonly AnswerRepository       $answerRepository,
        private readonly EntityManagerInterface $entityManager,
    )
    {
    }

    public function getQuizResult(array $answerIds): QuizDTO
    {
        $answers = $this->answerRepository->findBy(['id' => $answerIds]);
        $answersList = $this->sortAnswersByQuestionId($answers);
        $quizDTO = $this->processAnswers($answersList);
        $this->saveResult($quizDTO);
        return $quizDTO;
    }

    private function processAnswers(array $answersList): QuizDTO
    {
        $quizDTO = new QuizDTO();

        foreach ($answersList as $questionId => $answers) {
            $isSuccessful = true;
            $questionText = '';

            foreach ($answers as $answer) {
                $isSuccessful &= $answer->isCorrect();

                if (!$questionText) {
                    $questionText = $answer->getQuestion()->getText();
                }
            }

            $quizDTO->addQuestionData(
                $questionId,
                $isSuccessful,
                array_map(static fn($answer) => $answer->getId(), $answers),
                $questionText
            );
        }

        return $quizDTO;
    }

    private function sortAnswersByQuestionId(array $answers): array
    {
        $answersList = [];

        foreach ($answers as $answer) {
            $questionId = $answer->getQuestion()->getId();

            if (!isset($answersList[$questionId])) {
                $answersList[$questionId] = [];
            }

            $answersList[$questionId][] = $answer;
        }

        return $answersList;
    }

    private function saveResult(QuizDTO $quizDTO): void
    {
        $quizResult = new QuizResult(
            $quizDTO->getQuizResultDetails(),
        );

        $this->entityManager->persist($quizResult);
        $this->entityManager->flush();
    }
}