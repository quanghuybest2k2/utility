<?php

use PHPUnit\Framework\TestCase;
use quanghuybest2k2\utility\ArrayUtil;

class ArrayUtilTest extends TestCase
{
    public function testIsEmpty()
    {
        $emptyArray = [];
        $nonEmptyArray = [1, 2, 3];

        $this->assertTrue(ArrayUtil::isEmpty($emptyArray));
        $this->assertFalse(ArrayUtil::isEmpty($nonEmptyArray));
    }

    public function testReverse()
    {
        $originalArray = [1, 2, 3, 4, 5];
        $reversedArray = [5, 4, 3, 2, 1];

        $this->assertEquals($reversedArray, ArrayUtil::reverse($originalArray));
    }

    public function testGetFirst()
    {
        $array = [1, 2, 3, 4, 5];
        $firstElement = 1;

        $this->assertEquals($firstElement, ArrayUtil::getFirst($array));
    }

    public function testGetLast()
    {
        $array = [1, 2, 3, 4, 5];
        $lastElement = 5;

        $this->assertEquals($lastElement, ArrayUtil::getLast($array));
    }
}