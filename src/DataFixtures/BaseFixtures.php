<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

abstract class BaseFixtures extends Fixture
{
    protected \Faker\Generator $faker;
    protected ObjectManager $manager;

    public function load(ObjectManager $manager): void
    {
        $this->faker = Factory::create();
        $this->manager = $manager;

        $this->loadData($manager);
    }

    abstract function loadData(ObjectManager $manager):void;

    protected function create(string $className, callable $factory): object
    {
        $entity = new $className();
        $factory($entity);

        $this->manager->persist($entity);

        return $entity;
    }
    protected function createMany(string $className, int $count, callable $factory): void
    {
        for($i = 0; $i < $count; $i++) {
            $entity = $this->create($className, $factory);

            $this->addReference("$className|$i", $entity);
        }

        $this->manager->flush();
    }

    private array $referencesIndex = [];
    protected function getRandomReference($className)
    {
        if (! isset($this->referenceIndex[$className])) {
            $this->referencesIndex[$className] = [];

            foreach ($this->referenceRepository->getReferences() as $key => $reference) {
                if (stripos($key, $className . '|') === 0) {
                    $this->referencesIndex[$className][] = $key;
                }
            }
        }

        if (empty($this->referencesIndex[$className])) {
            throw new \Exception('Не найдены ссылки на класс: ' . $className);
        }

        return $this->getReference($this->faker->randomElement($this->referencesIndex[$className]));
    }
}
