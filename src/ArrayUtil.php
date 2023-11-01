<?php

namespace quanghuybest2k2\utility;

class ArrayUtil
{
    /**
     * Kiểm tra xem một mảng có trống hay không.
     *
     * @param array $array Mảng cần kiểm tra
     * @return bool True nếu mảng trống, ngược lại trả về false
     */
    public static function isEmpty($array)
    {
        return empty($array);
    }

    /**
     * Đảo ngược một mảng.
     *
     * @param array $array Mảng cần đảo ngược
     * @return array Mảng sau khi đảo ngược
     */
    public static function reverse($array)
    {
        return array_reverse($array);
    }

    /**
     * Lấy giá trị đầu tiên của mảng.
     *
     * @param array $array Mảng cần lấy giá trị đầu tiên
     * @return mixed Giá trị đầu tiên của mảng hoặc null nếu mảng trống
     */
    public static function getFirst($array)
    {
        return reset($array);
    }

    /**
     * Lấy giá trị cuối cùng của mảng.
     *
     * @param array $array Mảng cần lấy giá trị cuối cùng
     * @return mixed Giá trị cuối cùng của mảng hoặc null nếu mảng trống
     */
    public static function getLast($array)
    {
        return end($array);
    }
}