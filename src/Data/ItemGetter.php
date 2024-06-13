<?php declare(strict_types=1);

namespace Lemonade\DataLayer\Data;

/**
 * @Getter
 * @\Lemonade\DataLayer\Getter
 */
trait ItemGetter
{

    /**
     * @param string $name
     * @return string
     */
    public function __get(string $name)
    {

        return ($this->$name ?? "");
    }

}