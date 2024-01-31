<?php declare(strict_types=1);


namespace Lemonade\DataLayer\Model;

use Lemonade\DataLayer\Content;
use Lemonade\DataLayer\Event;
use Lemonade\DataLayer\Translator;
use Lemonade\DataLayer\Utils;
use stdClass;

/**
 * @Page
 * @package Lemonade\DataLayer
 */
final class Page extends Content
{

    /**
     * @var array|string[]
     */
    protected array $appConfig = [
        "cms::homepage" => "homepage",
        "cms::category" => "category",
        "cms::article" => "article",
        "cms::page" => "page",
        "cms::news" => "news",
        "cms::event" => "event",
        "cms::gallery" => "gallery",
        "cms::search" => "search",
        "eshop::search" => "eshopSearch",
        "eshop::category" => "eshopCategory",
        "eshop::product" => "productDetail",
        "eshop::cart" => "orderCart",
        "eshop::delivery" => "orderBillingAndShipping",
        "eshop::customer" => "orderCustomerDetails",
        "eshop::recapitulation" => "orderRecapitulation",
        "eshop::thank" => "orderThankYou",
        "eshop::status" => "orderCheckStatus",
    ];

    /**
     *
     * @var string
     */
    protected string $appPageType = "other";

    /**
     * @param string|null $index
     */
    public function __construct(protected readonly ?string $index = null)
    {
    }

    /**
     * @return stdClass
     */
    public function jsonSerialize(): stdClass
    {

        $result = new stdClass();
        $result->event = Event::DEFAULT_PAGE;
        $result->page = new stdClass();

        Utils::addProperty(data: $result->page, propertyName: "pageType", propertyValue: ($this->appConfig[$this->index] ?? "other"));

        return $result;
    }
}