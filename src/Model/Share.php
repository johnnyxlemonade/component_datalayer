<?php declare(strict_types=1);

namespace Lemonade\DataLayer\Model;

use Lemonade\DataLayer\Content;
use Lemonade\DataLayer\Event;
use Lemonade\DataLayer\Utils;
use stdClass;

/**
 * @Share
 * @\Lemonade\DataLayer\Model\Share
 * @see https://developers.google.com/analytics/devguides/collection/ga4/reference/events?client_type=gtag#share
 */
class Share extends Content
{

    /**
     * @param string|null $method
     * @param string|null $type
     * @param string|null $itemId
     */
    public function __construct(private readonly ?string $method = "", private readonly ?string $type = "", private readonly ?string $itemId = "")
    {
    }

    /**
     * @return stdClass
     */
    public function jsonSerialize(): stdClass
    {

        $result = new stdClass();
        $result->event = Event::SHARE->value;

        Utils::addProperty(data: $result, propertyName: "method", propertyValue: $this->method);
        Utils::addProperty(data: $result, propertyName: "content_type", propertyValue: $this->type);
        Utils::addProperty(data: $result, propertyName: "item_id", propertyValue: $this->itemId);

        return $result;
    }

}
