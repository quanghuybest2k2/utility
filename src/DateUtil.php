<?php

namespace quanghuybest2k2\utility;

class DateUtil
{
    /**
     * Chuyển định dạng ngày tháng từ chuỗi thành đối tượng DateTime.
     *
     * @param string $dateString Chuỗi ngày tháng
     * @param string $format Định dạng của chuỗi ngày tháng (mặc định là 'Y-m-d')
     * @return \DateTime|false Đối tượng DateTime hoặc false nếu chuỗi không hợp lệ
     */
    public static function parseDate($dateString, $format = 'Y-m-d')
    {
        return \DateTime::createFromFormat($format, $dateString);
    }

    /**
     * So sánh hai ngày tháng.
     *
     * @param string $date1 Ngày tháng 1 (chuỗi)
     * @param string $date2 Ngày tháng 2 (chuỗi)
     * @param string $format Định dạng của chuỗi ngày tháng (mặc định là 'Y-m-d')
     * @return int -1 nếu $date1 < $date2, 1 nếu $date1 > $date2, 0 nếu bằng nhau
     */
    public static function compareDates($date1, $date2, $format = 'Y-m-d')
    {
        $dateTime1 = self::parseDate($date1, $format);
        $dateTime2 = self::parseDate($date2, $format);

        if ($dateTime1 > $dateTime2) {
            return 1;
        } elseif ($dateTime1 < $dateTime2) {
            return -1;
        } else {
            return 0;
        }
    }

    /**
     * Lấy ngày hiện tại dưới dạng chuỗi với định dạng cho trước.
     *
     * @param string $format Định dạng của chuỗi ngày tháng (mặc định là 'Y-m-d H:i:s')
     * @return string Chuỗi ngày tháng hiện tại theo định dạng
     */
    public static function getCurrentDate($format = 'Y-m-d H:i:s')
    {
        return (new \DateTime())->format($format);
    }
}