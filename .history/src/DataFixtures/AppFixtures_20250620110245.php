<?php

namespace App\DataFixtures;

use App\Entity\Ingredient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\DBAL\Driver\IBMDB2\Exception\Factory;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

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
    
    use Faker\Factory;

public function load(ObjectManager $manager): void
{
    $faker = Factory::create(message: 'fr_FR');

    for ($i = 0; $i < 50; $i++) {
        $ingredient = new Ingredient();
        $ingredient->setName($faker->word());
        $ingredient->setPrice($faker->randomFloat(2, 0.5, 100));
        
        $manager->persist($ingredient);
    }

    $manager->flush();
}

}
