<?php declare(strict_types=1);

namespace Lemonade\DataLayer\Model;
use Lemonade\DataLayer\Currency;
use Lemonade\DataLayer\Event;
use Lemonade\DataLayer\Utils;
use Lemonade\DataLayer\Content;
use Lemonade\DataLayer\Translator;
use Lemonade\DataLayer\Data\Coupon;
use Lemonade\DataLayer\Data\Item;
use Lemonade\DataLayer\Data\Payment;
use Lemonade\DataLayer\Data\Shipping;
use Lemonade\DataLayer\Data\Transaction;
use stdClass;

/**
 * @Eccomerce
 * @package Lemonade\DataLayer
 */
class Eccomerce extends Content {

    /**
     * @var Shipping|null
     */
    protected Shipping|null $shipping = null;

    /**
     * @var Payment|null
     */
    protected Payment|null $payment = null;

    /**
     * @var Coupon|null
     */
    protected Coupon|null $coupon = null;

    /**
     * @var Transaction|null
     */
    protected Transaction|null $transaction = null;

    /**
     * @var array<Item>
     */
    protected $items = [];

    /**
     * @param Event $event
     * @param float $price
     * @param Currency $currency
     */
    public function __construct(private readonly Event $event, private readonly float $price = 0, private readonly Currency $currency = Currency::CZK) {}

    /**
     * @return Event
     */
    public function getEvent(): Event {

        return $this->event;
    }

    /**
     * @param Item $item
     * @return void
     */
    public function addItem(Item $item): void {

        $this->items[] = $item;
    }

    /**
     * @return Item[]
     */
    public function getItems(): array {

        return $this->items;
    }

    /**
     * @param Shipping $shipping
     * @return void
     */
    public function addShiping(Shipping $shipping): void {

        $this->shipping = $shipping;
    }

    /**
     * @return Shipping|null
     */
    public function getShipping(): Shipping|null {

        return $this->shipping;
    }

    /**
     * @param Payment $payment
     * @return void
     */
    public function addPayment(Payment $payment): void {

        $this->payment = $payment;
    }

    /**
     * @return Payment|null
     */
    public function getPayment(): Payment|null {

        return $this->payment;
    }


    /**
     * @param Coupon $coupon
     * @return void
     */
    public function addCoupon(Coupon $coupon): void {

        $this->coupon = $coupon;
    }

    /**
     * @return Coupon|null
     */
    public function getCoupon(): Coupon|null {

        return $this->coupon;
    }

    /**
     * @param Transaction $purchase
     * @return void
     */
    public function addTransaction(Transaction $purchase): void {

        $this->transaction = $purchase;
    }

    /**
     * @return Transaction|null
     */
    public function getTransaction(): Transaction|null {

        return $this->transaction;
    }

    /**
     * @return stdClass
     */
    public function jsonSerialize(): stdClass {

        $result = new stdClass();
        $result->event = $this->event->value;
        $result->ecommerce = new stdClass();

        Utils::addProperty($result->ecommerce, "value", $this->price);
        Utils::addProperty($result->ecommerce, "currency", $this->currency->value);

        if(!empty($this->transaction)) {

            Utils::addProperty($result->ecommerce, "transaction_id", $this->transaction->getTransactionId());
            Utils::addProperty($result->ecommerce, "affiliation", $this->transaction->getAffiliation());
        }

        if(!empty($this->shipping)) {

            Utils::addProperty($result->ecommerce, "shipping_tier", $this->shipping->name);
            Utils::addProperty($result->ecommerce, "shipping_value", $this->shipping->price);
        }

        if(!empty($this->payment)) {

            Utils::addProperty($result->ecommerce, "payment_type", $this->payment->name);
            Utils::addProperty($result->ecommerce, "payment_value", $this->payment->price);
        }

        if(!empty($this->coupon)) {

            Utils::addProperty($result->ecommerce, "coupon", $this->coupon->name);
        }

        Utils::addItems($result->ecommerce, $this->items);

        return $result;
    }

}
