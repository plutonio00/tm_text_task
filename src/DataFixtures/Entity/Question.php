<?php

namespace App\DataFixtures\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Question
{
    #[ORM\Id]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255)]
    private string $text;

    public function __construct(int $id, string $text)
    {
        $this->id = $id;
        $this->text = $text;
    }
}
