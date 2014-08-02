<?php

namespace TomPHP\SpecificationExample\Application\Specification;

interface SpecificationVisitor
{
    public function visitAnd(AndSpecification $specification);

    public function visitIsFree(IsFreeSpecification $specification);

    public function visitNewerThan(NewerThanSpecification $specification);
}
