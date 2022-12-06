<?php declare(strict_types=1);

namespace Lemonade\DataLayer;

trait Getter {

    /**
     * @param string $name
     * @return string
     */
    public function __get(string $name) {

        return (isset($this->$name) ? $this->$name : "");
    }

}