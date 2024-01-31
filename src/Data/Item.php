<?php declare(strict_types=1);

namespace Lemonade\DataLayer\Data;

use Lemonade\DataLayer\Currency;
use Lemonade\DataLayer\Getter;

/**
 * @package Lemonade\DataLayer
 * @see https://developers.google.com/analytics/devguides/collection/ga4/reference/events?client_type=gtag#add_to_cart
 */
final class Item
{

    use Getter;

    /**
     * @var float|null
     */
    protected ?float $price = null;

    /**
     * @var float|null
     */
    protected ?float $quantity = null;

    /**
     * @var string|null
     */
    protected ?string $affiliation = null;

    /**
     * @var string|null
     */
    protected ?string $coupon = null;

    /**
     * @var string|null
     */
    protected ?string $currency = null;

    /**
     * @var float|null
     */
    protected ?float $discount = null;

    /**
     * @var string|null
     */
    protected ?string $item_brand = null;

    /**
     * @var string|null
     */
    protected ?string $item_category = null;

    /**
     * @var string|null
     */
    protected ?string $item_category2 = null;

    /**
     * @var string|null
     */
    protected ?string $item_category3 = null;

    /**
     * @var string|null
     */
    protected ?string $item_category4 = null;

    /**
     * @var string|null
     */
    protected ?string $item_category5 = null;

    /**
     * @var string|null
     */
    protected ?string $item_list_id = null;

    /**
     * @var string|null
     */
    protected ?string $item_list_name = null;

    /**
     * @var string|null
     */
    protected ?string $item_variant = null;

    /**
     * @var string|null
     */
    protected ?string $location_id = null;

    /**
     * @param string $item_id
     * @param string $item_name
     */
    public function __construct(public string $item_id, public string $item_name)
    {
    }

    /**
     * @param float|null $price
     * @return $this
     */
    public function price(float $price = null): self
    {

        $this->price = $price;

        return $this;
    }


    /**
     * @param int|float|null $quantity
     * @return $this
     */
    public function quantity(int|float $quantity = null): self
    {

        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @param string|null $affiliation
     * @return $this
     */
    public function affiliation(string $affiliation = null): self
    {

        $this->affiliation = $affiliation;

        return $this;
    }

    /**
     * @param string|null $coupon
     * @return $this
     */
    public function coupon(string $coupon = null): self
    {

        $this->coupon = $coupon;

        return $this;
    }

    /**
     * @param string|null $currency
     * @return $this
     */
    public function currency(string $currency = null): self
    {

        $this->currency = (Currency::tryFrom(value: $currency) ?? "CZK");

        return $this;
    }

    /**
     * @param float|null $discount
     * @return $this
     */
    public function discount(float $discount = null): self
    {

        $this->discount = $discount;

        return $this;
    }

    /**
     * @param string|null $item_brand
     * @return $this
     */
    public function item_brand(string $item_brand = null): self
    {

        $this->item_brand = $item_brand;

        return $this;
    }

    /**
     * @param string|null $item_category
     * @return $this
     */
    public function item_category(string $item_category = null): self
    {

        $this->item_category = $item_category;

        return $this;
    }

    /**
     * @param string|null $item_category
     * @return $this
     */
    public function item_category2(string $item_category = null): self
    {

        $this->item_category2 = $item_category;

        return $this;
    }

    /**
     * @param string|null $item_category
     * @return $this
     */
    public function item_category3(string $item_category = null): self
    {

        $this->item_category3 = $item_category;

        return $this;
    }

    /**
     * @param string|null $item_category
     * @return $this
     */
    public function item_category4(string $item_category = null): self
    {

        $this->item_category4 = $item_category;

        return $this;
    }

    /**
     * @param string|null $item_category
     * @return $this
     */
    public function item_category5(string $item_category = null): self
    {

        $this->item_category5 = $item_category;

        return $this;
    }

    /**
     * @param string|null $item_list_id
     * @return $this
     */
    public function item_list_id(string $item_list_id = null): self
    {

        $this->item_list_id = $item_list_id;

        return $this;
    }

    /**
     * @param string|null $item_list_name
     * @return $this
     */
    public function item_list_name(string $item_list_name = null): self
    {

        $this->item_list_name = $item_list_name;

        return $this;
    }

    /**
     * @param string|null $item_variant
     * @return $this
     */
    public function item_variant(string $item_variant = null): self
    {

        $this->item_variant = $item_variant;

        return $this;
    }

    /**
     * @param string|null $location_id
     * @return $this
     */
    public function location_id(string $location_id = null): self
    {

        $this->location_id = $location_id;

        return $this;
    }


}