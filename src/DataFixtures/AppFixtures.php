<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
         $product = new Product();
         $product->setName("Shoes");
         $product->setPrice(2137);
         $manager->persist($product);

        $manager->flush();
    }
}
