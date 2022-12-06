<?php declare(strict_types=1);

namespace Lemonade\DataLayer\Data;

/**
 * @Transaction
 * @package Lemonade\DataLayer
 */
final class Transaction {

    /**
     * @var string|null
     */
    protected ?string $affiliation = null;

    /**
     * @var float|null
     */
    protected ?float $tax = null;

    /**
     * @param string $transactionId
     */
    public function __construct(private readonly string $transactionId) {}

    /**
     * @return string
     */
    public function getTransactionId(): string {

        return $this->transactionId;
    }

    /**
     * @param string|null $affiliation
     * @return $this
     */
    public function setAffiliation(string $affiliation = null): self {

        $this->affiliation = $affiliation;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAffiliation(): string|null {

        return $this->affiliation;
    }

    /**
     * @param $tax
     * @return $this
     */
    public function setTax($tax): self {

        $this->tax = $tax;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getTax(): float|null {

        return $this->tax;
    }

}