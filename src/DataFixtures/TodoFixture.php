<?php

namespace App\DataFixtures;

use App\Entity\Todo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
;

class TodoFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=0; $i < 50; $i++){
            $todo = new Todo();
            $todo->setTache("Tache $i");
            $todo->setAuthor("Abdoulaye");

            $manager->persist($todo);
        }
        $manager->flush();
    }
}
