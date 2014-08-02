<?php

namespace TomPHP\SpecificationExample\Value;

use DateTime;

final class Date
{
    /** @var DateTime */
    private $date;

    /**
     * @param string $date
     *
     * @return Date
     */
    public static function fromDate($date)
    {
        return new self(new DateTime($date));
    }

    private function __construct(DateTime $date)
    {
        $this->date = $date;
    }

    /** @return bool */
    public function isMoreRecentThan(Date $other)
    {
        return $this->date > $other->date;
    }

    public function __toString()
    {
        return $this->date->format('Y-m-d');
    }
}
