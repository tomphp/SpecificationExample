<?php

namespace TomPHP\SpecificationExample\SQLiteRepository;

use PDO;
use TomPHP\SpecificationExample\Specification\SpecificationVisitor;
use TomPHP\SpecificationExample\Specification\AndSpecification;
use TomPHP\SpecificationExample\Specification\IsFreeSpecification;
use TomPHP\SpecificationExample\Specification\NewerThanSpecification;

final class SQLiteSpecificationVisitor implements SpecificationVisitor
{
    /** @var PDO */
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function visitAnd(AndSpecification $specification)
    {
        return implode(
            ' AND ',
            array_map(
                function ($spec) {
                    return $spec->accept($this);
                },
                $specification->getSpecifications()
            )
        );
    }

    public function visitIsFree(IsFreeSpecification $specification)
    {
        return 'price=0';
    }

    public function visitNewerThan(NewerThanSpecification $specification)
    {
        return 'releaseDate > ' . $this->db->quote((string) $specification->getDate());
    }
}
