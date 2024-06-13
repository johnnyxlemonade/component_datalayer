<?php declare(strict_types=1);

namespace Lemonade\DataLayer\Data;

/**
 * @Coupon
 * @\Lemonade\DataLayer\Data\Coupon
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