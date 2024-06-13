<?php declare(strict_types=1);

namespace Lemonade\DataLayer;

use Stringable;
use function json_encode;

/**
 * @Layer
 * @\Lemonade\DataLayer\Layer
 */
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

        if ($content instanceof Content) {

            $this->content = $content;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function render(): string
    {

        $data = "[]";
        $test = json_encode(value: ($this->content ?? []));

        if($test !== false) {

            $data = $test;
        }

        return ($data === "[]" ? "" : 'dataLayer.push(' . $data . ');');
    }

    /**
     * @return array<mixed>
     */
    public function toArray(): array
    {

        if ($this->content instanceof Content) {

            return $this->content->toArray();
        }

        return [];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {

        return $this->render();
    }


}