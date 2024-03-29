<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255)]
    private string $text;

    #[ORM\OneToMany(mappedBy: 'question', targetEntity: AnswerVariant::class, fetch: 'EAGER')]
    private Collection $answersVariants;

    #[ORM\OneToMany(mappedBy: 'question', targetEntity: Answer::class)]
    private Collection $answers;

    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getAnswersVariants(): Collection
    {
        return $this->answersVariants;
    }

    public function getShuffleAnswersVariants(): array {
        $answersVariants = $this->answersVariants->toArray();
        shuffle($answersVariants);
        return $answersVariants;
    }
}
