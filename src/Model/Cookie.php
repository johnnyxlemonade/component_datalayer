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
final class Cookie extends Content
{

    const GRANTED = "granted";
    const DENIED  = "denied";

    /**
     * @param bool $marketing
     * @param bool $analytics
     */
    public function __construct(protected readonly bool $marketing = false, protected readonly bool $analytics = false) {}

    /**
     * @return stdClass
     */
    public function jsonSerialize(): stdClass
    {

        $result = new stdClass();
        $result->event  = "cookie_consent";
        $result->data = new stdClass();

        Utils::addProperty(data: $result->data, propertyName: "marketing", propertyValue: ($marketing ? self::GRANTED : self::DENIED));
        Utils::addProperty(data: $result->data, propertyName: "analytics", propertyValue: ($analytics ? self::GRANTED : self::DENIED));

        return $result;
    }
}