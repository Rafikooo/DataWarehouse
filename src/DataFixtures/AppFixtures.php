<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Factory\ProductFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $file = file_get_contents(__DIR__ . "/Shoes.json");
        $data = json_decode($file, true);
        foreach ($data as $item) {
            $product = new Product();
            $product->setName($item['name']);
            $product->setPrice((int)$item['price']);
            $product->setCategory($item['base_cat_name']);
            $manager->persist($product);
        }

        $manager->flush();
    }
}
