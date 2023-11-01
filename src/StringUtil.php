<?php

namespace quanghuybest2k2\utility;

use voku\helper\ASCII;

class StringUtil
{
    /**
     * Cắt chuỗi thành độ dài tối đa và thêm dấu chấm ba nếu cần thiết.
     *
     * @param string $text Chuỗi đầu vào
     * @param int $length Độ dài tối đa của chuỗi cắt
     * @return string Chuỗi đã cắt với dấu chấm ba nếu được thêm vào
     */
    public static function truncate($text, $length)
    {
        if (mb_strlen($text) > $length) {
            $text = mb_substr($text, 0, $length);
            // Kiểm tra xem ký tự cuối cùng có phải là dấu cách không, nếu có, loại bỏ nó và thêm dấu chấm ...
            if (mb_substr($text, -1) === ' ') {
                $text = rtrim($text);
            } else {
                $text = rtrim($text) . '...';
            }
        }
        return $text;
    }

    /**
     * Tham khao code nonAccentVietnamese.js => https://gist.github.com/jarvisluong/f01e108e963092336f04c4b7dd6f7e45
     *  Chuyển đổi một chuỗi thành định dạng slug (URL friendly).
     *
     * @param string $text Chuỗi cần chuyển đổi thành slug
     * @return string Slug được tạo ra từ chuỗi đầu vào
     */
    public static function slugify($text)
    {
        // Chuyển đổi chuỗi tiếng Việt có dấu thành chuỗi không dấu
        $text = ASCII::to_ascii($text);
        // Loại bỏ các ký tự không mong muốn, giữ lại chữ cái Latin không dấu, số và dấu gạch ngang
        $text = preg_replace('/[^a-zA-Z0-9\-]/', '-', $text);
        $text = strtolower($text);
        // Loại bỏ các khoảng trắng kéo dài và dấu gạch ngang ở đầu và cuối chuỗi
        $text = preg_replace('/-+/', '-', $text);
        $text = trim($text, '-');
        return $text;
    }

    /**
     * Định dạng số tiền thành chuỗi có dấu phẩy ngăn cách hàng nghìn, triệu, tỷ, ...
     *
     * @param float $number Số tiền cần định dạng
     * @return string Chuỗi số tiền đã được định dạng
     */
    public static function formatCurrency($number)
    {
        return number_format($number, 0, '.', ',');
    }

    /**
     * Rút ngắn tên người dùng hoặc tên file thành dạng viết tắt.
     *
     * @param string $name Tên cần rút ngắn
     * @return string Tên đã được rút ngắn
     */
    public static function shortenName($name)
    {
        $parts = explode(' ', $name);
        $shortenedName = '';
        foreach ($parts as $part) {
            $shortenedName .= strtoupper($part[0]);
        }
        return $shortenedName;
    }

    /**
     * Kiểm tra xem chuỗi có chứa từ khóa hay không.
     *
     * @param string $text Chuỗi cần kiểm tra
     * @param string $keyword Từ khóa cần tìm kiếm
     * @return bool True nếu chuỗi chứa từ khóa, ngược lại trả về false
     */
    public static function containsKeyword($text, $keyword)
    {
        return stripos($text, $keyword) !== false;
    }

}