<?php

namespace TomPHP\SpecificationExample\Application\Specification;

use Assert\Assertion;
use TomPHP\SpecificationExample\Application\Video;

final class IsFreeSpecification implements Specification
{
    public function isSatisfiedBy($video)
    {
        Assertion::isInstanceOf($video, Video::class);

        return $video->isFree();
    }

    public function accept(SpecificationVisitor $visitor)
    {
        return $visitor->visitIsFree($this);
    }
}
