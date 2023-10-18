<?php declare(strict_types=1);

namespace Lemonade\DataLayer;

use Exception;
use Stringable;
use function json_encode;

final class Layer implements Stringable
{

    /**
     * @var Content|null
     */
    protected ?Content $content = null;

    /**
     * @param Content|null $content
     * @return self
     */
    public function create(Content $content = null): self
    {

        if (!empty($content)) {

            $this->content = $content;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function render(): string
    {

        try {

            $encoded = json_encode(value: ($this->content ?? []));

        } catch (Exception) {

            $encoded = "[]";
        }


        return ($encoded === "[]" ? "" : 'dataLayer.push(' . $encoded . ');');
    }

    /**
     * @return array
     */
    public function toArray(): array
    {

        return $this->content->toArray();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {

        return $this->render();
    }


}