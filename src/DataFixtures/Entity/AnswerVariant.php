<?php

namespace App\DataFixtures\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class AnswerVariant
{
    #[ORM\Id]
    #[ORM\Column]
    private int $id;

    #[ORM\ManyToOne(inversedBy: 'answersVariants')]
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
}
