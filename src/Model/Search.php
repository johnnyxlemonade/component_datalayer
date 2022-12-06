<?php declare(strict_types=1);

namespace Lemonade\DataLayer\Model;
use Lemonade\DataLayer\Content;
use Lemonade\DataLayer\Event;
use Lemonade\DataLayer\Translator;
use Lemonade\DataLayer\Utils;
use stdClass;

/**
 * @Search
 * @package Lemonade\DataLayer
 * @link https://developers.google.com/analytics/devguides/collection/ga4/reference/events?client_type=gtag#search
 */
class Search extends Content {

    /**
     * @param string|null $term
     */
    public function __construct(private readonly ?string $term = "") {}

    /**
     * @return stdClass
     */
    public function jsonSerialize(): stdClass {

        $result = new stdClass();
        $result->event = Event::SEARCH->value;

        Utils::addProperty($result, "search_term", $this->term);

        return $result;
    }

}
