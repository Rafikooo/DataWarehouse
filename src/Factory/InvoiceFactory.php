<?php

namespace App\Factory;

use App\Entity\Invoice;
use App\Repository\InvoiceRepository;
use Faker\Provider\DateTime;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Invoice>
 *
 * @method static Invoice|Proxy createOne(array $attributes = [])
 * @method static Invoice[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Invoice|Proxy find(object|array|mixed $criteria)
 * @method static Invoice|Proxy findOrCreate(array $attributes)
 * @method static Invoice|Proxy first(string $sortedField = 'id')
 * @method static Invoice|Proxy last(string $sortedField = 'id')
 * @method static Invoice|Proxy random(array $attributes = [])
 * @method static Invoice|Proxy randomOrCreate(array $attributes = [])
 * @method static Invoice[]|Proxy[] all()
 * @method static Invoice[]|Proxy[] findBy(array $attributes)
 * @method static Invoice[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Invoice[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static InvoiceRepository|RepositoryProxy repository()
 * @method Invoice|Proxy create(array|callable $attributes = [])
 */
final class InvoiceFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        $date = self::faker()->dateTimeBetween('2018-01-01');
        return [
            'number' => self::faker()->numberBetween(50, 100) . "/" . $date->format('d/m/Y'),
            'date' => $date
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Invoice $invoice) {})
        ;
    }

    protected static function getClass(): string
    {
        return Invoice::class;
    }
}
