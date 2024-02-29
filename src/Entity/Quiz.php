<?php

namespace App\Entity;

use App\Repository\QuizRepository;
use DateTime;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuizRepository::class)]
class Quiz
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(type: 'datetime', options: ['default' => 'CURRENT_TIMESTAMP'])]
    private DateTime $finishedAt;

    #[ORM\OneToMany(mappedBy: 'quiz', targetEntity: Answer::class, cascade: ['persist'])]
    private Collection $answers;

    public function __construct(DateTime $finishedAt)
    {
        $this->answers = new ArrayCollection();
        $this->finishedAt = $finishedAt;
    }

    public function addAnswer(Answer $answer): static
    {
        if (!$this->answers->contains($answer)) {
            $this->answers->add($answer);
            $answer->setQuiz($this);
        }

        return $this;
    }

    public function getStatistic(): array
    {
        $rightAnswers = $this->answers->filter(fn(Answer $answer) => $answer->isRight());
        $wrongAnswers = $this->answers->filter(fn(Answer $answer) => !$answer->isRight());

        return [
            'rightAnswers' => $rightAnswers,
            'wrongAnswers' => $wrongAnswers,
            'rightAnswersCount' => count($rightAnswers),
            'wrongAnswersCount' => count($wrongAnswers),
            'answersCount' => count($this->answers),
        ];
    }
}
