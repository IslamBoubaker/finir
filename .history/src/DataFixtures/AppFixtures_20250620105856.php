<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
      $ingredients = [
            ['name' => 'Tomato', 'price' => 1.20],
            ['name' => 'Lettuce', 'price' => 0.80],
            ['name' => 'Cheese', 'price' => 2.50],
            ['name' => 'Bacon', 'price' => 3.00],
            ['name' => 'Chicken', 'price' => 4.00],
        ];
        $manager->flush();
    }
}
