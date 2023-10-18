<?php declare(strict_types=1);

namespace Lemonade\DataLayer;

use JsonSerializable;
use stdClass;

abstract class Content extends stdClass implements JsonSerializable
{

    /**
     * @return stdClass
     * @see JsonSerializable::jsonSerialize()
     */
    abstract public function jsonSerialize(): stdClass;

    /**
     * @return array
     */
    public function toArray(): array
    {

        return (array)$this->jsonSerialize();
    }

}