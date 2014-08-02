<?php

namespace TomPHP\SpecificationExample\Specification;

interface Specification
{
    /** @return bool */
    public function isSatisfiedBy($object);

    public function accept(SpecificationVisitor $visitor);
}
