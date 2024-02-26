<?php

namespace App\Entity;

use App\Repository\AnswerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnswerRepository::class)]
class Answer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\ManyToOne(inversedBy: 'answers')]
    #[ORM\JoinColumn(name: 'question_id', referencedColumnName: 'id', nullable: false)]
    private Question $question;

    #[ORM\Column(length: 255)]
    private string $text;

    #[ORM\Column(name: 'is_correct')]
    private bool $isCorrect;

    /**
     * @param Question $questionId
     * @param string $text
     * @param bool $isCorrect
     */
    public function __construct(
        Question $question,
        string $text,
        bool $isCorrect,
    )
    {
        $this->question = $question;
        $this->text = $text;
        $this->isCorrect = $isCorrect;
    }
}
