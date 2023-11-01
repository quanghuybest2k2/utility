<?php

use PHPUnit\Framework\TestCase;
use quanghuybest2k2\utility\DateUtil;

class DateUtilTest extends TestCase
{
    //------------------------------------- testParseDate() ----------------------------------------
    public function testValidDateString(): void
    {
        $dateString = '01-11-2023';
        $expectedFormat = 'd-m-Y';
        $parsedDate = DateUtil::parseDate($dateString, $expectedFormat);
        $this->assertInstanceOf(DateTime::class, $parsedDate);
        $this->assertEquals($dateString, $parsedDate->format($expectedFormat));
    }

    public function testInvalidDateString(): void
    {
        $invalidDateString = 'sai-format-ne';
        $parsedDate = DateUtil::parseDate($invalidDateString);
        $this->assertFalse($parsedDate);
    }

    public function testCustomDateFormat(): void
    {
        $dateString = '2023-11-01';
        $expectedFormat = 'd/m/Y';
        $parsedDate = DateUtil::parseDate($dateString, $expectedFormat);

        // Kiểm tra xem parseDate trả về false khi định dạng không đúng
        $this->assertFalse($parsedDate);
    }

    public function testDefaultFormat(): void
    {
        $dateString = '01-11-2023';
        $expectedFormat = 'd-m-Y';
        $parsedDate = DateUtil::parseDate($dateString);
        $this->assertInstanceOf(DateTime::class, $parsedDate);
        $this->assertEquals($dateString, $parsedDate->format($expectedFormat));
    }

    //------------------------------------- testCompareDates() ----------------------------------------
    // return 0
    public function testCompareDatesEqual()
    {
        $date1 = '01-01-2023';
        $date2 = '01-01-2023';
        $result = DateUtil::compareDates($date1, $date2);
        $this->assertEquals(0, $result);
    }

    // return -1
    public function testCompareDatesLessThan()
    {
        $date1 = '01-01-2022';
        $date2 = '01-01-2023';
        $result = DateUtil::compareDates($date1, $date2);
        $this->assertEquals(-1, $result);
    }

    // return 1
    public function testCompareDatesGreaterThan()
    {
        $date1 = '01-01-2024';
        $date2 = '01-01-2023';
        $result = DateUtil::compareDates($date1, $date2);
        $this->assertEquals(1, $result);
    }

    // return -1
    public function testCompareDatesWithCustomFormat()
    {
        $date1 = '2023-01-01';
        $date2 = '2023-01-02';
        $format = 'Y-m-d';
        $result = DateUtil::compareDates($date1, $date2, $format);
        $this->assertEquals(-1, $result);
    }

}