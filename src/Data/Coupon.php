<?php declare(strict_types=1);

namespace Lemonade\DataLayer\Data;

/**
 * @Shipping
 * @package Lemonade\DataLayer
 */
final class Coupon
{

    /**
     * @param string|null $name
     */
    public function __construct(public ?string $name = null)
    {
    }
}