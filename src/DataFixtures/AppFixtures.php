<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Factory\CustomerFactory;
use App\Factory\InvoiceFactory;
use App\Factory\InvoiceItemFactory;
use App\Factory\ProductFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private ObjectManager $manager;

    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;
        CustomerFactory::createMany(50);
        $this->loadProducts();

        $yearMonths = $this->getMonthYearTuples(01, 2018, 10, 2021);
        $quantity = 1;

        foreach ($yearMonths as $yearMonth) {
            $this->loadInvoicesByMonthAndYear($yearMonth['month'], $yearMonth['year'], $quantity);
        }
        $repository = InvoiceFactory::repository();
        $count = $repository->count();
        for($i = 0; $i < $count; $i++) {
            InvoiceItemFactory::createMany(random_int(10, 20), function() use($i) {
                return [
                    'invoice' => InvoiceFactory::random(),
                    'product' => ProductFactory::random()
                ];
            });
        }


    }

    private function getMonthYearTuples(int $beginMonth, int $beginYear, int $endMonth, int $endYear): array
    {
        $yearMonthStart = 12 * $beginYear + $beginMonth - 1;
        $yearMonthEnd = 12 * $endYear + $endMonth - 1;
        for($i = $yearMonthStart; $i <= $yearMonthEnd; $i++) {
            $year = intdiv($i, 12);
            $month = $i % 12 + 1;
            $result[] = ['year' => $year, 'month' => $month];
        }

        return $result ?? [];
    }


    private function loadProducts(): void
    {
        $file = file_get_contents(__DIR__ . "/Shoes.json");
        $data = json_decode($file, true);
        foreach ($data as $item) {
            $product = new Product();
            $product->setName($item['name']);
            $product->setPrice((int)$item['price']);
            $product->setCategory($item['base_cat_name']);
            $this->manager->persist($product);
        }

        $this->manager->flush();
    }

    private function loadInvoicesByMonthAndYear(int $month, int $year, int $quantity): void
    {
        for($i = 0; $i < $quantity; $i++) {
            InvoiceFactory::createMany($quantity, function() use($i, $month, $year) {
                $invoiceNumber = sprintf('%05d/%d/%d', $i, $month, $year);
                $invoiceDate = \DateTime::createFromFormat('Y-m-d', sprintf('%d-%d-%d', $year, $month, $i / 20)); // TODO

                return [
                    'number' => $invoiceNumber,
                    'date' => $invoiceDate,
                    'customer' => CustomerFactory::random()
                ];
            });
        }
    }
}