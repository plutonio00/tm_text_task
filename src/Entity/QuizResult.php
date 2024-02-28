<?php

namespace App\Entity;

use App\Repository\QuizResultRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuizResultRepository::class)]
class QuizResult
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column]
    private int $questionsCount;

    #[ORM\Column]
    private int $correctQuestionsCount;

    #[ORM\Column(type: Types::TEXT)]
    private string $details;

    public function __construct(
        int $questionsCount,
        int $correctQuestionsCount,
        string $details,
    )
    {
        $this->questionsCount = $questionsCount;
        $this->correctQuestionsCount = $correctQuestionsCount;
        $this->details = $details;
    }


}
