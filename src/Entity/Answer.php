<?php

namespace App\Entity;

use App\Repository\AnswerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnswerRepository::class)]
class Answer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'answers')]
    #[ORM\JoinColumn(nullable: false)]
    private Quiz $quiz;

    #[ORM\Column]
    private bool $isRight;

    #[ORM\ManyToOne(inversedBy: 'answers')]
    #[ORM\JoinColumn(nullable: false)]
    private Question $question;

    #[ORM\ManyToMany(targetEntity: AnswerVariant::class, inversedBy: 'answers')]
    private Collection $variants;

    public function __construct(
        Question $question,
        array $variants,
    )
    {
        $this->question = $question;
        $this->variants = new ArrayCollection($variants);
        $this->isRight = $this->checkAnswer();
    }

    private function checkAnswer(): bool
    {
        $isRight = true;

        foreach ($this->variants as $variant) {
            $isRight = $isRight && $variant->isCorrect();
        }

        return $isRight;
    }

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function getVariants(): Collection
    {
        return $this->variants;
    }

    public function setQuiz(Quiz $quiz): void
    {
        $this->quiz = $quiz;
    }

    public function isRight(): bool
    {
        return $this->isRight;
    }
}
