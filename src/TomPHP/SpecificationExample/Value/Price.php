<?php

namespace TomPHP\SpecificationExample\Value;

final class Price
{
    /** @var int */
    private $value;

    /**
     * @param int $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }
}
