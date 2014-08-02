<?php

namespace TomPHPTest\SpecificationExample\Application\Specification;

use TomPHP\SpecificationExample\Application\Video;
use TomPHP\SpecificationExample\Application\Specification\NewerThanSpecification;
use TomPHP\SpecificationExample\Application\Date;
use TomPHP\SpecificationExample\Application\Price;

final class NewerThanSpecificationTest extends \PHPUnit_Framework_TestCase
{
    /** @var NewerThanSpecification */
    private $specification;

    protected function setUp()
    {
        $this->specification = new NewerThanSpecification(Date::fromDate('2014-05-08'));
    }

    public function test_it_is_a_specification()
    {
        $this->assertInstanceOf(
            'TomPHP\SpecificationExample\Application\Specification\Specification',
            $this->specification
        );
    }

    public function test_visitor()
    {
        $visitor = $this->getMock('TomPHP\SpecificationExample\Application\Specification\SpecificationVisitor');

        $visitor->expects($this->once())
                ->method('visitNewerThan')
                ->with($this->identicalTo($this->specification))
                ->will($this->returnValue('result'));

        $this->assertEquals('result', $this->specification->accept($visitor));
    }

    public function test_return_date()
    {
        $this->assertEquals(Date::fromDate('2014-05-08'), $this->specification->getDate());
    }

    public function test_it_rejects_non_video_objects()
    {
        $this->setExpectedException('InvalidArgumentException');

        $this->specification->isSatisfiedBy(new \stdClass());
    }

    public function test_it_is_not_satisfied_by_old_videos()
    {
        $this->assertFalse($this->specification->isSatisfiedBy(
            new Video('video title', Date::fromDate('2014-04-22'), new Price(0))
        ));
    }

    public function test_it_is_satisfied_by_newer_vidoes()
    {
        $this->assertTrue($this->specification->isSatisfiedBy(
            new Video('video title', Date::fromDate('2014-05-15'), new Price(0))
        ));
    }
}
