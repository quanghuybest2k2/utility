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
        $input = 'Đây là ký tự tối đa nè bạn ơi!';
        $length = 30; // max length
        $result = StringUtil::truncate($input, $length);
        $this->assertEquals($input, $result);
    }

    public function testTruncateTextWithSpaceAtMaxLengthPlusOne()
    {
        $input = 'This is a long text that needs to be truncated';
        $length = 46; // Length of input text + 1
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
        $expectedOutput = '1,000';
        $result = StringUtil::formatCurrency($number);
        $this->assertEquals($expectedOutput, $result);
    }

    public function testFormatCurrencyWithFloat()
    {
        $number = 12345.67;
        $expectedOutput = '12,346';
        $result = StringUtil::formatCurrency($number);
        $this->assertEquals($expectedOutput, $result);
    }

    public function testFormatCurrencyWithLargeNumber()
    {
        $number = 1000000;
        $expectedOutput = '1,000,000';
        $result = StringUtil::formatCurrency($number);
        echo $result;
        $this->assertEquals($expectedOutput, $result);
    }

    public function testFormatCurrencyWithNegativeNumber()
    {
        $number = -5000;
        $expectedOutput = '-5,000';
        $result = StringUtil::formatCurrency($number);
        $this->assertEquals($expectedOutput, $result);
    }

    //------------------------------------- testShortenName() ----------------------------------------
    public function testShortenNameWithMultipleWords()
    {
        $inputName = "Đoàn Quang Huy";
        $expectedOutput = "DQH";
        $result = StringUtil::shortenName($inputName);
//        echo $result;
        $this->assertEquals($expectedOutput, $result);
    }

    public function testShortenNameWithSingleWord()
    {
        $inputName = "Nguyễn";
        $expectedOutput = "N";
        $this->assertEquals($expectedOutput, StringUtil::shortenName($inputName));
    }

    public function testShortenNameWithEmptyString()
    {
        $inputName = "   ";
        $expectedOutput = "";
        $this->assertEquals($expectedOutput, StringUtil::shortenName($inputName));
    }

    public function testShortenNameWithLeadingTrailingSpaces()
    {
        $inputName = "  Nguyễn      Quỳnh ";
        $expectedOutput = "NQ";
        $this->assertEquals($expectedOutput, StringUtil::shortenName($inputName));
    }

    //------------------------------------- testContainsKeyword() ----------------------------------------
    public function testContainsKeywordWithMatchingKeyword()
    {
        $text = 'Huy Cận - Nhà thơ hiện đại, không chỉ biết làm thơ mà còn biết nói đạo lý';
        $keyword = 'Nhà thơ';
        $result = StringUtil::containsKeyword($text, $keyword);
        $this->assertTrue($result);
    }

    public function testContainsKeywordWithNonMatchingKeyword()
    {
        $text = 'Huy Cận - Nhà thơ hiện đại, không chỉ biết làm thơ mà còn biết nói đạo lý';
        $keyword = 'Sơn Tùng MTP';// từ này không có
        $result = StringUtil::containsKeyword($text, $keyword);
        $this->assertFalse($result);
    }

    public function testContainsKeywordWithEmptyText()
    {
        $text = '';
        $keyword = 'Sơn Tùng MTP';
        $result = StringUtil::containsKeyword($text, $keyword);
        $this->assertFalse($result);
    }

    public function testContainsKeywordWithEmptyKeyword()
    {
        $text = 'Huy Cận - Nhà thơ hiện đại, không chỉ biết làm thơ mà còn biết nói đạo lý';
        $keyword = '';
        $result = StringUtil::containsKeyword($text, $keyword);
        $this->assertTrue($result);
    }

    public function testContainsKeywordWithCaseInsensitiveMatch()
    {
        $text = 'Huy Cận - Nhà thơ hiện đại, không chỉ biết làm thơ mà còn biết nói đạo lý';
        $keyword = 'NHÀ THƠ';// không phân biệt hoa thường
        $result = StringUtil::containsKeyword($text, $keyword);
        $this->assertTrue($result);
    }
}