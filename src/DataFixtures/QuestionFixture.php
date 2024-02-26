<?php

namespace App\DataFixtures;

use App\Entity\Question;
use Doctrine\Persistence\ObjectManager;

class QuestionFixture extends BaseFixture
{
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