<?php

namespace TomPHP\SpecificationExample\Value;

use TomPHP\SpecificationExample\Value\Date;

final class DateTest extends \PHPUnit_Framework_TestCase
{
    public function test_is_more_recent_than_older_date()
    {
        $date = Date::fromDate('2014-03-04');

        $this->assertTrue($date->isMoreRecentThan(Date::fromDate('2014-01-22')));
    }

    public function test_is_more_recent_than_newer_date()
    {
        $date = Date::fromDate('2014-03-04');

        $this->assertFalse($date->isMoreRecentThan(Date::fromDate('2014-05-22')));
    }

    public function test_to_string()
    {
        $this->assertEquals('2014-05-02', (string) Date::fromDate('2014-05-02'));
    }
}
