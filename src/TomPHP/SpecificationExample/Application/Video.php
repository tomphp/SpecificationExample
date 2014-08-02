<?php

namespace TomPHP\SpecificationExample\Application;

use TomPHP\SpecificationExample\Application\Date;
use TomPHP\SpecificationExample\Application\Price;

final class Video
{
    /** @var string */
    private $title;

    /** @var Date */
    private $releaseDate;

    /** @var Price */
    private $price;

    /** @param string $title */
    public function __construct($title, Date $releaseDate, Price $price)
    {
        $this->title = $title;
        $this->releaseDate = $releaseDate;
        $this->price = $price;
    }

    /** @return boolean */
    public function isFree()
    {
        return $this->price->getValue() == 0;
    }

    /** @return bool */
    public function isMoreRecentThan(Date $date)
    {
        return $this->releaseDate->isMoreRecentThan($date);
    }

    /** @return string */
    public function getTitle()
    {
        return $this->title;
    }

    /** @return Date */
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    /** @return Price */
    public function getPrice()
    {
        return $this->price;
    }
}
