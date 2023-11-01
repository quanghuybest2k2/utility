<?php

use PHPUnit\Framework\TestCase;
use quanghuybest2k2\utility\StringUtil;

class StringUtilTest extends TestCase
{
    //------------------------------------- testTruncate() ----------------------------------------
    public function testTruncateWithShortText()
    {
        // nếu quá 20 ký tự thì thêm .... vd: ouput: Không quá 20 ký tự là ok...
        $text = "Không quá 20 ký tự";
        $length = 20;
        $result = StringUtil::truncate($text, $length);
        echo $result;
        $this->assertEquals($text, $result);
    }

    public function testTruncateLongString()
    {
        $input = 'Huy Cận: Muốn đi con đường mà không ai đi được chỉ có lối đi riêng';
        $expectedOutput = 'Huy Cận: Muốn đi con đường mà không ai đi được chỉ...';
        $result = StringUtil::truncate($input, 50);
        echo $result;
        $this->assertEquals($expectedOutput, $result);
    }

    public function testTruncateTextWithSpaceAtMaxLength()
    {
        $input = 'This is a long text that needs to be truncated';
        $length = 47; // Length of input text
        $result = StringUtil::truncate($input, $length);
        $this->assertEquals($input, $result);
    }

    public function testTruncateTextWithSpaceAtMaxLengthPlusOne()
    {
        $input = 'This is a long text that needs to be truncated';
        $length = 48; // Length of input text + 1
        $result = StringUtil::truncate($input, $length);
        $expectedOutput = 'This is a long text that needs to be truncated';
        $this->assertEquals($expectedOutput, $result);
    }

    public function testTruncateWithEmptyText()
    {
        $text = "";
        $length = 20;
        $result = StringUtil::truncate($text, $length);
        $this->assertEquals($text, $result);
    }

//------------------------------------- testSlugify() ----------------------------------------
    public function testSlugifyRemovesSpecialCharacters()
    {
        $input = 'Đoàn!@#$%^Quang$$$Huy';
        $expectedOutput = 'doan-quang-huy';
        $this->assertEquals($expectedOutput, StringUtil::slugify($input));
    }

    public function testSlugifyConvertsSpacesToDashes()
    {
        $input = 'Hello World';
        $expectedOutput = 'hello-world';
        $this->assertEquals($expectedOutput, StringUtil::slugify($input));
    }

    public function testSlugifyRemovesLeadingAndTrailingDashes()
    {
        $input = '-hello-world-';
        $expectedOutput = 'hello-world';
        $this->assertEquals($expectedOutput, StringUtil::slugify($input));
    }

    public function testSlugifyHandlesUTF8Characters()
    {
        $input = 'Thực Phẩm Tiêu Dùng';
        $expectedOutput = 'thuc-pham-tieu-dung';
        $this->assertEquals($expectedOutput, StringUtil::slugify($input));
    }

    public function testSlugifyHandlesMultipleSpaces()
    {
        $input = 'Hello     World';
        $expectedOutput = 'hello-world';
        $this->assertEquals($expectedOutput, StringUtil::slugify($input));
    }

    public function testSlugifyHandlesEmptyString()
    {
        $input = '';
        $expectedOutput = '';
        $this->assertEquals($expectedOutput, StringUtil::slugify($input));
    }

    //------------------------------------- testFormatCurrency() ----------------------------------------
    public function testFormatCurrencyWithInteger()
    {
        $number = 1000;
        $formattedNumber = StringUtil::formatCurrency($number);
        $this->assertEquals('1,000', $formattedNumber);
    }

    public function testFormatCurrencyWithFloat()
    {
        $number = 12345.67;
        $formattedNumber = StringUtil::formatCurrency($number);
        $this->assertEquals('12,346', $formattedNumber);
    }

    public function testFormatCurrencyWithLargeNumber()
    {
        $number = 1000000;
        $formattedNumber = StringUtil::formatCurrency($number);
        $this->assertEquals('1,000,000', $formattedNumber);
    }

    public function testFormatCurrencyWithNegativeNumber()
    {
        $number = -5000;
        $formattedNumber = StringUtil::formatCurrency($number);
        $this->assertEquals('-5,000', $formattedNumber);
    }

    //------------------------------------- testShortenName() ----------------------------------------

    public function testShortenName()
    {
        $name = 'John Doe';
        $shortenedName = StringUtil::shortenName($name);
        $this->assertEquals('JD', $shortenedName);
    }

    //------------------------------------- testContainsKeyword() ----------------------------------------
    public function testContainsKeyword()
    {
        $text = 'This is a sample text containing the word "sample".';
        $keyword = 'sample';

        $this->assertTrue(StringUtil::containsKeyword($text, $keyword));

        $text = 'This text does not contain the keyword.';
        $this->assertFalse(StringUtil::containsKeyword($text, $keyword));
    }
}