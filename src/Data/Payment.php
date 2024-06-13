<?php declare(strict_types=1);

namespace Lemonade\DataLayer\Data;

/**
 * @Payment
 * @\Lemonade\DataLayer\Data\Payment
 */
final class Payment
{

    /**
     * @param string|null $name
     * @param float|null $price
     */
    public function __construct(public ?string $name = null, public ?float  $price = null)
    {

    }

}