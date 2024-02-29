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

    /**
     * @return Collection<int, Answer>
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function addAnswer(Answer $answer): static
    {
        if (!$this->answers->contains($answer)) {
            $this->answers->add($answer);
            $answer->setQuiz($this);
        }

        return $this;
    }

    public function removeAnswer(Answer $answer): static
    {
        if ($this->answers->removeElement($answer)) {
            // set the owning side to null (unless already changed)
            if ($answer->getQuiz() === $this) {
                $answer->setQuiz(null);
            }
        }

        return $this;
    }

    public function getAnswersCount(): int
    {
        return count($this->answers);
    }

    public function getRightAnswersCount(): int
    {
        return $this->answers->filter(fn($answer) => $answer->isRigth())->count();
    }

    public function getWrongAnswersCount(): int
    {
        return $this->answers->filter(fn($answer) => !$answer->isRigth())->count();
    }

    public function getRightAnswers(): Collection
    {
        return $this->answers->filter(fn($answer) => $answer->isRigth());
    }

    public function getWrongAnswers(): Collection
    {
        return $this->answers->filter(fn($answer) => !$answer->isRigth());
    }
}
