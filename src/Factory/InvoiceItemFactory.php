<?php

namespace App\Factory;

use App\Entity\InvoiceItem;
use App\Repository\InvoiceItemRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<InvoiceItem>
 *
 * @method static InvoiceItem|Proxy createOne(array $attributes = [])
 * @method static InvoiceItem[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static InvoiceItem|Proxy find(object|array|mixed $criteria)
 * @method static InvoiceItem|Proxy findOrCreate(array $attributes)
 * @method static InvoiceItem|Proxy first(string $sortedField = 'id')
 * @method static InvoiceItem|Proxy last(string $sortedField = 'id')
 * @method static InvoiceItem|Proxy random(array $attributes = [])
 * @method static InvoiceItem|Proxy randomOrCreate(array $attributes = [])
 * @method static InvoiceItem[]|Proxy[] all()
 * @method static InvoiceItem[]|Proxy[] findBy(array $attributes)
 * @method static InvoiceItem[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static InvoiceItem[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static InvoiceItemRepository|RepositoryProxy repository()
 * @method InvoiceItem|Proxy create(array|callable $attributes = [])
 */
final class InvoiceItemFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            // TODO add your default values here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories)
            'quantity' => self::faker()->randomNumber(),
            'price' => self::faker()->randomNumber(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(InvoiceItem $invoiceItem) {})
        ;
    }

    protected static function getClass(): string
    {
        return InvoiceItem::class;
    }
}
