<?php

namespace App\Tests\Integration;

use App\Service\QuizService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class QuizServiceTest extends KernelTestCase
{

    /** @dataProvider variantsProvider */
    public function testProcessData(array $variantsIds, array $expectedStatistic): void
    {
        self::bootKernel();
        $quizService = self::getContainer()->get(QuizService::class);
        $quiz = $quizService->getQuizResult($variantsIds);
        $actualStatistic = $quiz->getStatistic();

        self::assertEquals(
            $expectedStatistic['rightAnswersCount'],
            $actualStatistic['rightAnswersCount']
        );

        self::assertEquals(
            $expectedStatistic['wrongAnswersCount'],
            $actualStatistic['wrongAnswersCount']
        );

        self::assertEquals(
            $expectedStatistic['answersCount'],
            $actualStatistic['answersCount']
        );

        $rightAnswers = $actualStatistic['rightAnswers'];
        $wrongAnswers = $actualStatistic['wrongAnswers'];

        $rightAnswersQuestionsIds = array_map(static fn($answer) => $answer->getQuestion()->getId(), $rightAnswers->toArray());
        $wrongAnswersQuestionsIds = array_map(static fn($answer) => $answer->getQuestion()->getId(), $wrongAnswers->toArray());

        self::assertEmpty(array_diff(
            $expectedStatistic['wrongAnswersQuestionsIds'], $wrongAnswersQuestionsIds
        ));

        self::assertEmpty(array_diff(
            $expectedStatistic['rightAnswersQuestionsIds'], $rightAnswersQuestionsIds
        ));
    }

    public static function variantsProvider(): array
    {
        return [
            'all variants are correct' => [
                'variantsIds' => [1, 3, 4, 5, 7, 8, 9, 11, 12, 13, 17],
                'expectedStatistic' => [
                    'rightAnswersQuestionsIds' => [2, 5],
                    'wrongAnswersQuestionsIds' => [1, 3, 4],
                    'rightAnswersCount' => 2,
                    'wrongAnswersCount' => 3,
                    'answersCount' => 5,
                ],
            ],
        ];
    }
}