<?php

namespace TomPHPTest\SpecificationExample\Specification;

use TomPHP\SpecificationExample\Entity\Video;
use TomPHP\SpecificationExample\Specification\IsFreeSpecification;
use TomPHP\SpecificationExample\Value\Date;
use TomPHP\SpecificationExample\Value\Price;

final class IsFreeSpecificationTest extends \PHPUnit_Framework_TestCase
{
    /** @var IsFreeSpecification */
    private $specification;

    protected function setUp()
    {
        $this->specification = new IsFreeSpecification();
    }

    public function test_is_a_specification()
    {
        $this->assertInstanceOf(
            'TomPHP\SpecificationExample\Specification\Specification',
            $this->specification
        );
    }

    public function test_visitor()
    {
        $visitor = $this->getMock('TomPHP\SpecificationExample\Specification\SpecificationVisitor');

        $visitor->expects($this->once())
                ->method('visitIsFree')
                ->with($this->identicalTo($this->specification))
                ->will($this->returnValue('result'));

        $this->assertEquals('result', $this->specification->accept($visitor));
    }

    public function test_it_rejects_non_video_objects()
    {
        $this->setExpectedException('InvalidArgumentException');

        $this->specification->isSatisfiedBy(new \stdClass());
    }

    public function test_it_is_satisfied_by_a_free_video()
    {
        $video = new Video('video', Date::fromDate('2014-01-01'), new Price(0));
        $this->assertTrue($this->specification->isSatisfiedBy($video));
    }

    public function test_it_is_not_satisfied_by_a_premium_video()
    {
        $video = new Video('video', Date::fromDate('2014-01-01'), new Price(10));
        $this->assertFalse($this->specification->isSatisfiedBy($video));
    }
}
