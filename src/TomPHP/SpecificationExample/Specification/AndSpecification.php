<?php

namespace TomPHP\SpecificationExample\Specification;

final class AndSpecification implements Specification
{
    /** @var Specification */
    private $specification1;

    /** @var Specification */
    private $specification2;

    public function __construct(Specification $specification1, Specification $specification2)
    {
        $this->specification1 = $specification1;
        $this->specification2 = $specification2;
    }

    public function isSatisfiedBy($video)
    {
        return $this->specification1->isSatisfiedBy($video)
            && $this->specification2->isSatisfiedBy($video);
    }

    public function accept(SpecificationVisitor $visitor)
    {
        return $visitor->visitAnd($this);
    }

    /** @return Specification[] */
    public function getSpecifications()
    {
        return [
            $this->specification1,
            $this->specification2
        ];
    }
}
