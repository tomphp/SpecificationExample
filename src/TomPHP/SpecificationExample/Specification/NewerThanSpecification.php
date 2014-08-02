<?php

namespace TomPHP\SpecificationExample\Specification;

use Assert\Assertion;
use TomPHP\SpecificationExample\Entity\Video;
use TomPHP\SpecificationExample\Value\Date;

final class NewerThanSpecification implements Specification
{
    /** @var Date */
    private $date;

    public function __construct(Date $date)
    {
        $this->date = $date;
    }

    public function isSatisfiedBy($video)
    {
        Assertion::isInstanceOf($video, Video::class);

        return $video->isMoreRecentThan($this->date);
    }

    public function accept(SpecificationVisitor $visitor)
    {
        return $visitor->visitNewerThan($this);
    }

    /** @return Date */
    public function getDate()
    {
        return $this->date;
    }
}
