<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Exception;
use RuntimeException;

abstract class BaseFixture extends Fixture
{
    abstract protected function getDataFile(): string;

    protected function getDataContent(): array
    {
        $file = $this->getDataFile();
        if (!file_exists($file)) {
            throw new RuntimeException('File not found');
        }

        return include $file;
    }
}