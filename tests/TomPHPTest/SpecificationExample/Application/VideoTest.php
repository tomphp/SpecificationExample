<?php

namespace TomPHPTest\SpecificationExample\Application;

use TomPHP\SpecificationExample\Application\Video;
use TomPHP\SpecificationExample\Application\Date;
use TomPHP\SpecificationExample\Application\Price;

final class VideoTest extends \PHPUnit_Framework_TestCase
{
    public function test_if_a_video_is_free()
    {
        $video = new Video('video', Date::fromDate('2014-01-01'), new Price(0));

        $this->assertTrue($video->isFree());
    }

    public function test_if_a_video_is_not_free()
    {
        $video = new Video('video', Date::fromDate('2014-01-01'), new Price(5));

        $this->assertFalse($video->isFree());
    }

    public function test_if_a_video_is_newer_than_a_given_date()
    {
        $video = new Video('video', Date::fromDate('2014-05-01'), new Price(0));

        $this->assertTrue($video->isMoreRecentThan(Date::fromDate('2014-04-25')));
    }

    public function test_if_a_video_is_older_than_a_given_date()
    {
        $video = new Video('video', Date::fromDate('2014-05-01'), new Price(0));

        $this->assertFalse($video->isMoreRecentThan(Date::fromDate('2014-05-25')));
    }
}
