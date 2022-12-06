<?php declare(strict_types=1);

namespace Lemonade\DataLayer\Model;
use Lemonade\DataLayer\Content;
use Lemonade\DataLayer\Event;
use Lemonade\DataLayer\Utils;
use stdClass;

/**
 * @Share
 * @package Lemonade\DataLayer
 * @link https://developers.google.com/analytics/devguides/collection/ga4/reference/events?client_type=gtag#share
 */
class Share extends Content {

    /**
     * @param string|null $method
     * @param string|null $type
     * @param string|null $itemId
     */
    public function __construct(private readonly ?string $method = "", private readonly ?string $type = "", private readonly ?string $itemId = "") {}

    /**
     * @return stdClass
     */
    public function jsonSerialize(): stdClass {

        $result = new stdClass();
        $result->event = Event::SHARE->value;

        Utils::addProperty($result, "method", $this->method);
        Utils::addProperty($result, "content_type", $this->type);
        Utils::addProperty($result, "item_id", $this->itemId);

        return $result;
    }

}
