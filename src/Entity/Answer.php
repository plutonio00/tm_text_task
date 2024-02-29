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
        bool $isRight,
        Question $question,
        array $variants,
        Quiz $quiz,
    )
    {
        $this->isRight = $isRight;
        $this->question = $question;
        $this->variants = new ArrayCollection($variants);
        $this->quiz = $quiz;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuiz(): ?Quiz
    {
        return $this->quiz;
    }

    public function setQuiz(?Quiz $quiz): static
    {
        $this->quiz = $quiz;

        return $this;
    }

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): static
    {
        $this->question = $question;

        return $this;
    }

    /**
     * @return Collection<int, AnswerVariant>
     */
    public function getVariants(): Collection
    {
        return $this->variants;
    }

    public function addVariant(AnswerVariant $variant): static
    {
        if (!$this->variants->contains($variant)) {
            $this->variants->add($variant);
        }

        return $this;
    }

    public function removeVariant(AnswerVariant $variant): static
    {
        $this->variants->removeElement($variant);

        return $this;
    }
}
