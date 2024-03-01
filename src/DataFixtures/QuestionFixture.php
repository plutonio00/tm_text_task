<?php

namespace App\DataFixtures;

use App\DataFixtures\Entity\Question;
use Doctrine\Persistence\ObjectManager;

class QuestionFixture extends BaseFixture
{
    public const ID_1 = 1;
    public const ID_2 = 2;
    public const ID_3 = 3;
    public const ID_4 = 4;
    public const ID_5 = 5;

    protected function getDataFile(): string
    {
        return __DIR__ . '/data/questions.php';
    }

    public function load(ObjectManager $manager): void
    {
        $data = $this->getDataContent();

        foreach ($data as $item) {
            $entity = new Question($item['id'], $item['text']);
            $manager->persist($entity);
            $this->addReference('question_' . $item['id'], $entity);
        }

        $manager->flush();
    }
}