<?php

namespace TomPHPTest\SpecificationExample\Application\Specification;

use TomPHP\SpecificationExample\Application\Date;
use TomPHP\SpecificationExample\Application\Price;
use TomPHP\SpecificationExample\Application\Specification\AndSpecification;
use TomPHP\SpecificationExample\Application\Specification\Specification;
use TomPHP\SpecificationExample\Application\Video;

final class AndSpecificationTest extends \PHPUnit_Framework_TestCase
{
    /** @var AndSpecification */
    private $andSpecification;

    /** @var Specification */
    private $specification1;

    /** @var Specification */
    private $specification2;

    /** @var Video */
    private $object;

    protected function setUp()
    {
        $this->specification1 = $this->getMock('TomPHP\SpecificationExample\Application\Specification\Specification');
        $this->specification2 = $this->getMock('TomPHP\SpecificationExample\Application\Specification\Specification');

        $this->andSpecification = new AndSpecification($this->specification1, $this->specification2);

        $this->object = new \stdClass();
    }

    public function test_it_is_a_specification()
    {
        $this->assertInstanceOf(
            'TomPHP\SpecificationExample\Application\Specification\Specification',
            $this->andSpecification
        );
    }

    public function test_visitor()
    {
        $visitor = $this->getMock('TomPHP\SpecificationExample\Application\Specification\SpecificationVisitor');

        $visitor->expects($this->once())
                ->method('visitAnd')
                ->with($this->identicalTo($this->andSpecification))
                ->will($this->returnValue('result'));

        $this->assertEquals('result', $this->andSpecification->accept($visitor));
    }

    public function test_getSpecifications()
    {
        $this->assertEquals(
            [$this->specification1, $this->specification2],
            $this->andSpecification->getSpecifications()
        );
    }

    public function test_it_does_satisfy_if_both_specifications_satisfy()
    {
        $this->setSpecificationIsSatisifiedBy($this->specification1, true);
        $this->setSpecificationIsSatisifiedBy($this->specification2, true);

        $this->assertTrue($this->andSpecification->isSatisfiedBy($this->object));
    }

    public function test_it_does_not_satisfy_if_neither_specifications_satisfy()
    {
        $this->setSpecificationIsSatisifiedBy($this->specification1, false);
        $this->setSpecificationIsSatisifiedBy($this->specification2, false);

        $this->assertFalse($this->andSpecification->isSatisfiedBy($this->object));
    }

    public function test_it_does_not_satisfy_if_only_specification1_satisfies()
    {
        $this->setSpecificationIsSatisifiedBy($this->specification1, true);
        $this->setSpecificationIsSatisifiedBy($this->specification2, false);

        $this->assertFalse($this->andSpecification->isSatisfiedBy($this->object));
    }

    public function test_it_does_not_satisfy_if_only_specification2_satisfies()
    {
        $this->setSpecificationIsSatisifiedBy($this->specification1, false);
        $this->setSpecificationIsSatisifiedBy($this->specification2, true);

        $this->assertFalse($this->andSpecification->isSatisfiedBy($this->object));
    }

    /**
     * @param Specification $specification
     * @param  bool              $satisfied
     */
    public function setSpecificationIsSatisifiedBy($specification, $satisfied)
    {
        $specification
             ->expects($this->any())
             ->method('isSatisfiedBy')
             ->with($this->identicalTo($this->object))
             ->will($this->returnValue($satisfied));
    }
}
