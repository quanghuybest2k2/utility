<?php

use PHPUnit\Framework\TestCase;
use quanghuybest2k2\utility\DateUtil;

class DateUtilTest extends TestCase
{
    public function testParseDate()
    {
        $dateString = '2023-11-01';
        $expectedDate = DateTime::createFromFormat('Y-m-d', $dateString);

        $parsedDate = DateUtil::parseDate($dateString);
        $this->assertInstanceOf(DateTime::class, $parsedDate);
        $this->assertEquals($expectedDate, $parsedDate);
    }

    public function testCompareDates()
    {
        $date1 = '2023-11-01';
        $date2 = '2023-11-02';

        $this->assertEquals(-1, DateUtil::compareDates($date1, $date2));
        $this->assertEquals(1, DateUtil::compareDates($date2, $date1));
        $this->assertEquals(0, DateUtil::compareDates($date1, $date1));
    }

    public function testGetCurrentDate()
    {
        $currentDate = DateUtil::getCurrentDate('Y-m-d H:i:s');
        $this->assertNotNull($currentDate);

        $parsedCurrentDate = DateTime::createFromFormat('Y-m-d H:i:s', $currentDate);
        $this->assertInstanceOf(DateTime::class, $parsedCurrentDate);

        $this->assertEquals(date('Y-m-d H:i:s'), $parsedCurrentDate->format('Y-m-d H:i:s'));
    }
}