<?php declare(strict_types=1);

namespace Lemonade\DataLayer\Model;

use Lemonade\DataLayer\Content;
use Lemonade\DataLayer\Currency;
use Lemonade\DataLayer\Data\Coupon;
use Lemonade\DataLayer\Data\Item;
use Lemonade\DataLayer\Data\Payment;
use Lemonade\DataLayer\Data\Shipping;
use Lemonade\DataLayer\Data\Transaction;
use Lemonade\DataLayer\Event;
use Lemonade\DataLayer\Utils;
use stdClass;

/**
 * @Eccomerce
 * @package Lemonade\DataLayer
 */
class Eccomerce extends Content
{

    /**
     * @var Shipping|null
     */
    protected ?Shipping $shipping = null;

    /**
     * @var Payment|null
     */
    protected ?Payment $payment = null;

    /**
     * @var Coupon|null
     */
    protected ?Coupon $coupon = null;

    /**
     * @var Transaction|null
     */
    protected ?Transaction $transaction = null;

    /**
     * @var array<Item>
     */
    protected array $items = [];

    /**
     * @param Event $event
     * @param float $price
     * @param Currency $currency
     */
    public function __construct(private readonly Event $event, private readonly float $price = 0, private readonly Currency $currency = Currency::CZK)
    {
    }

    /**
     * @return Event
     */
    public function getEvent(): Event
    {

        return $this->event;
    }

    /**
     * @param Item $item
     * @return void
     */
    public function addItem(Item $item): void
    {

        $this->items[] = $item;
    }

    /**
     * @return Item[]
     */
    public function getItems(): array
    {

        return $this->items;
    }

    /**
     * @param Shipping $shipping
     * @return void
     */
    public function addShiping(Shipping $shipping): void
    {

        $this->shipping = $shipping;
    }

    /**
     * @return Shipping|null
     */
    public function getShipping(): Shipping|null
    {

        return $this->shipping;
    }

    /**
     * @param Payment $payment
     * @return void
     */
    public function addPayment(Payment $payment): void
    {

        $this->payment = $payment;
    }

    /**
     * @return Payment|null
     */
    public function getPayment(): Payment|null
    {

        return $this->payment;
    }

    /**
     * @param Coupon $coupon
     * @return void
     */
    public function addCoupon(Coupon $coupon): void
    {

        $this->coupon = $coupon;
    }

    /**
     * @return Coupon|null
     */
    public function getCoupon(): Coupon|null
    {

        return $this->coupon;
    }

    /**
     * @param Transaction $purchase
     * @return void
     */
    public function addTransaction(Transaction $purchase): void
    {

        $this->transaction = $purchase;
    }

    /**
     * @return Transaction|null
     */
    public function getTransaction(): Transaction|null
    {

        return $this->transaction;
    }

    /**
     * @return stdClass
     */
    public function jsonSerialize(): stdClass
    {

        $result = new stdClass();
        $result->event = $this->event->value;

        // detail produktu
        if($this->event->name === "DETAIL_PRODUCT") {


            Utils::addProperty(data: $result, propertyName: "value", propertyValue: $this->price);
            Utils::addProperty(data: $result, propertyName: "currency", propertyValue: $this->currency->value);
            Utils::addItems(ecommerce: $result, items: $this->items);

        } else {

            $result->ecommerce = new stdClass();

            Utils::addProperty(data: $result->ecommerce, propertyName: "value", propertyValue: $this->price);
            Utils::addProperty(data: $result->ecommerce, propertyName: "currency", propertyValue: $this->currency->value);


            if (!empty($this->transaction)) {

                Utils::addProperty(data: $result->ecommerce, propertyName: "transaction_id", propertyValue: $this->transaction->getTransactionId());
                Utils::addProperty(data: $result->ecommerce, propertyName: "affiliation", propertyValue: $this->transaction->getAffiliation());
            }

            if (!empty($this->shipping)) {

                Utils::addProperty(data: $result->ecommerce, propertyName: "shipping_tier", propertyValue: $this->shipping->name);
                Utils::addProperty(data: $result->ecommerce, propertyName: "shipping_value", propertyValue: $this->shipping->price);
            }

            if (!empty($this->payment)) {

                Utils::addProperty(data: $result->ecommerce, propertyName: "payment_type", propertyValue: $this->payment->name);
                Utils::addProperty(data: $result->ecommerce, propertyName: "payment_value", propertyValue: $this->payment->price);
            }

            if (!empty($this->coupon)) {

                Utils::addProperty(data: $result->ecommerce, propertyName: "coupon", propertyValue: $this->coupon->name);
            }

            Utils::addItems(ecommerce: $result->ecommerce, items: $this->items);
        }

        return $result;
    }

}
