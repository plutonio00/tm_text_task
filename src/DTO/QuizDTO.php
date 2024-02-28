<?php

namespace App\DTO;

class QuizDTO
{
    private int $questionsCount;
    private array $successfulQuestions;
    private array $failedQuestions;

    public function __construct(
        int $questionsCount,
    )
    {
        $this->questionsCount = $questionsCount;
        $this->successfulQuestions = [];
        $this->failedQuestions = [];
    }

    public function addQuestionData(
        int    $id,
        bool   $isSuccessful,
        array  $answerIds,
        string $text,
    ): void
    {
        $type = $isSuccessful ? 'successful' : 'failed';

        $this->{$type . 'Questions'}[$id] = [
            'answer_ids' => $answerIds,
            'text' => $text,
        ];
    }

    public function getQuestionsCount(): int
    {
        return $this->questionsCount;
    }

    public function getSuccessfulQuestionsCount(): int
    {
        return count($this->successfulQuestions);
    }

    public function getQuizResultDetails(): string
    {
        $removeText = static function ($array) {
            unset($array['text']);
            return $array;
        };

        $failedQuestions = array_map($removeText, $this->failedQuestions);
        $successfulQuestions = array_map($removeText, $this->failedQuestions);

        return serialize([
            'failed_questions' => $failedQuestions,
            'successful_questions' => $successfulQuestions,
        ]);
    }

    public function getSuccessfulQuestions(): array
    {
        return $this->successfulQuestions;
    }

    public function getFailedQuestions(): array
    {
        return $this->failedQuestions;
    }
}