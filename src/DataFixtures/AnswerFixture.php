<?php

namespace App\DataFixtures;

use App\DataFixtures\Entity\AnswerVariant;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AnswerFixture extends BaseFixture implements DependentFixtureInterface
{
    protected function getDataFile(): string
    {
        return __DIR__ . '/data/answers_variants.php';
    }

    public function getDependencies(): array
    {
        return [
            QuestionFixture::class,
        ];
    }

    public function load(ObjectManager $manager): void
    {
        $data = $this->getDataContent();


        foreach ($data as $item) {
            $entity = new AnswerVariant(
                $item['id'],
                $this->getReference('question_' . $item['question_id']),
                $item['text'],
                $item['is_correct'],
            );
            $manager->persist($entity);
        }

        $manager->flush();
    }
}