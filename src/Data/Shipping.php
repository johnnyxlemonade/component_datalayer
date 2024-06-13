<?php declare(strict_types=1);

namespace Lemonade\DataLayer\Data;

/**
 * @Shipping
 * @package Lemonade\DataLayer
 */
final class Shipping
{

    /**
     * @param string|null $name
     * @param float|null $price
     */
    public function __construct(public ?string $name = null, public ?float $price = null)
    {

    }

}