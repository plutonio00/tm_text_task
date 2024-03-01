<?php

namespace App\DataFixtures\Entity;

use App\Repository\AnswerVariantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnswerVariantRepository::class)]
class AnswerVariant
{
    #[ORM\Id]
    #[ORM\Column]
    private int $id;

    #[ORM\ManyToOne(inversedBy: 'answers')]
    #[ORM\JoinColumn(nullable: false)]
    private Question $question;

    #[ORM\Column(length: 255)]
    private string $text;

    #[ORM\Column(name: 'is_correct')]
    private bool $isCorrect;

    public function __construct(
        int $id,
        Question $question,
        string $text,
        bool $isCorrect
    )
    {
        $this->id = $id;
        $this->question = $question;
        $this->text = $text;
        $this->isCorrect = $isCorrect;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getQuestion(): Question
    {
        return $this->question;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function isCorrect(): bool
    {
        return $this->isCorrect;
    }
}
