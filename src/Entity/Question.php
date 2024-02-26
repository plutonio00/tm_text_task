<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255)]
    private string $text;

    #[ORM\OneToMany(mappedBy: 'question_id', targetEntity: Answer::class)]
    private Collection $answers;

    public function __construct(int $id, string $text)
    {
        $this->id = $id;
        $this->text = $text;
    }
}
