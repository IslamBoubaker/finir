<?php

namespace App\DataFixtures;

use App\Entity\Ingredient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
      $ingredients = new Ingredient();
        $ingredients->setname('ingredient #1');
        $ingredients->setPrice(10.99);  
        $manager->persist($ingredients);
        $manager->flush();
    }
    
}
