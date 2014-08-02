<?php

namespace TomPHPTest\SpecificationExample\Repository;

use TomPHP\SpecificationExample\Entity\Video;
use TomPHP\SpecificationExample\Specification\AndSpecification;
use TomPHP\SpecificationExample\Specification\IsFreeSpecification;
use TomPHP\SpecificationExample\Specification\NewerThanSpecification;
use TomPHP\SpecificationExample\Value\Date;
use TomPHP\SpecificationExample\Value\Price;
use TomPHP\SpecificationExample\Specification\Specification;

abstract class VideoRepositoryTest extends \PHPUnit_Framework_TestCase
{
    /** @var VideoRepository */
    protected $repository;

    /** @var Video[] */
    private $videos = [];

    protected function setUp()
    {
        $this->videos[] = new Video('free vid 1', Date::fromDate('2014-02-04'), new Price(0));
        $this->videos[] = new Video('premium vid 1', Date::fromDate('2014-02-12'), new Price(10));
        $this->videos[] = new Video('free vid 2', Date::fromDate('2014-03-12'), new Price(0));

        foreach ($this->videos as $video) {
            $this->repository->save($video);
        }
    }

    private function assertGetBySpecificationMatchesFor(Specification $specification)
    {
        $videos = array_filter(
            $this->repository->fetchAll(),
            function (Video $video) use ($specification) {
                return $specification->isSatisfiedBy($video);
            }
        );

        $this->assertEquals(
            array_values($videos),
            array_values($this->repository->fetchBySpecifcation($specification))
        );
    }

    public function test_it_is_a_VideoRepository()
    {
        $this->assertInstanceOf(
            'TomPHP\SpecificationExample\Repository\VideoRepository',
            $this->repository
        );
    }

    public function test_it_fetches_all_videos()
    {
        $this->assertEquals($this->videos, $this->repository->fetchAll());
    }

    public function test_is_free_specification()
    {
        $this->assertGetBySpecificationMatchesFor(new IsFreeSpecification());
    }

    public function test_new_than_specification()
    {
        $this->assertGetBySpecificationMatchesFor(
            new NewerThanSpecification(Date::fromDate('2014-02-10'))
        );
    }

    public function test_is_free_and_new_than_specification()
    {
        $this->assertGetBySpecificationMatchesFor(
            new AndSpecification(
                new IsFreeSpecification(),
                new NewerThanSpecification(Date::fromDate('2014-02-10'))
            )
        );
    }
}
