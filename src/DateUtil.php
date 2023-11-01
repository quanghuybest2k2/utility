<?php

namespace quanghuybest2k2\utility;

use DateTime;
use DateTimeZone;

class DateUtil
{
    /**
     * Chuyển định dạng ngày tháng từ chuỗi thành đối tượng DateTime.
     *
     * @param string $dateString Chuỗi ngày tháng
     * @param string $format Định dạng của chuỗi ngày tháng (mặc định là 'd-m-Y')
     * @return DateTime|false Đối tượng DateTime hoặc false nếu chuỗi không hợp lệ
     */
    public static function parseDate($dateString, $format = 'd-m-Y'): DateTime|false
    {
        return DateTime::createFromFormat($format, $dateString);
    }

    /**
     * So sánh hai ngày tháng.
     *
     * @param string $date1 Ngày tháng 1 (chuỗi)
     * @param string $date2 Ngày tháng 2 (chuỗi)
     * @param string $format Định dạng của chuỗi ngày tháng (mặc định là 'd-m-Y')
     * @return int -1 nếu $date1 < $date2, 1 nếu $date1 > $date2, 0 nếu bằng nhau
     */
    public static function compareDates($date1, $date2, $format = 'd-m-Y'): int
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
     * @param string $format Định dạng của chuỗi ngày tháng (mặc định là 'd-m-Y H:i:s')
     * @return string Chuỗi ngày tháng hiện tại theo định dạng
     */
    public static function getCurrentDate($format = 'd-m-Y H:i:s'): string
    {
        return (new DateTime())->format($format);
    }

    /**
     * Phương thức để lấy ngày giờ hiện tại theo múi giờ của Việt Nam.
     *
     * @return string Chuỗi ngày giờ hiện tại theo múi giờ của Việt Nam (d-m-Y H:i:s).
     */
    public static function getCurrentDateTimeInVietnamTimeZone(): string
    {
        $vietnamTimeZone = new DateTimeZone('Asia/Ho_Chi_Minh');
        $currentDateTime = new DateTime('now', $vietnamTimeZone);
        return $currentDateTime->format('d-m-Y H:i:s');
    }

    /**
     * Phương thức để chuyển đổi ngày giờ từ múi giờ khác thành múi giờ của Việt Nam.
     *
     * @param string $dateTimeString Chuỗi ngày giờ cần chuyển đổi.
     * @param string $originalTimeZone Múi giờ ban đầu của chuỗi ngày giờ.
     * @return string Chuỗi ngày giờ sau khi chuyển đổi theo múi giờ của Việt Nam (d-m-Y H:i:s).
     */
    public static function convertToVietnamTimeZone($dateTimeString, $originalTimeZone): string
    {
        $originalTimeZoneObject = new DateTimeZone($originalTimeZone);
        $vietnamTimeZone = new DateTimeZone('Asia/Ho_Chi_Minh');
        $dateTime = new DateTime($dateTimeString, $originalTimeZoneObject);
        $dateTime->setTimezone($vietnamTimeZone);
        return $dateTime->format('d-m-Y H:i:s');
    }

    /**
     * Phương thức để kiểm tra xem một ngày giờ có nằm trong khoảng thời gian cho trước hay không.
     *
     * @param string $dateTimeString Chuỗi ngày giờ cần kiểm tra.
     * @param string $startDateTimeString Chuỗi ngày giờ bắt đầu của khoảng thời gian (d-m-Y H:i:s).
     * @param string $endDateTimeString Chuỗi ngày giờ kết thúc của khoảng thời gian (d-m-Y H:i:s).
     * @return bool True nếu ngày giờ nằm trong khoảng thời gian, ngược lại là false.
     */
    public static function isDateTimeInRange($dateTimeString, $startDateTimeString, $endDateTimeString): bool
    {
        $dateTime = new DateTime($dateTimeString);
        $startDateTime = new DateTime($startDateTimeString);
        $endDateTime = new DateTime($endDateTimeString);
        return $dateTime >= $startDateTime && $dateTime <= $endDateTime;
    }

    /**
     * Phương thức để lấy số ngày giữa hai ngày.
     *
     * @param string $startDate Chuỗi ngày bắt đầu (d-m-Y).
     * @param string $endDate Chuỗi ngày kết thúc (d-m-Y).
     * @return int Số ngày giữa hai ngày.
     */
    public static function getDaysDifference($startDate, $endDate): int
    {
        $startDateTime = new DateTime($startDate);
        $endDateTime = new DateTime($endDate);
        $interval = $startDateTime->diff($endDateTime);
        return $interval->days;
    }

    /**
     * Phương thức để lấy tên của tháng từ số tháng (1-12).
     *
     * @param int $monthNumber Số tháng (từ 1 đến 12).
     * @return string Tên của tháng hoặc 'Tháng không hợp lệ' nếu số tháng không hợp lệ.
     */
    public static function getMonthName($monthNumber): string
    {
        $months = [
            1 => 'Tháng 1',
            2 => 'Tháng 2',
            3 => 'Tháng 3',
            4 => 'Tháng 4',
            5 => 'Tháng 5',
            6 => 'Tháng 6',
            7 => 'Tháng 7',
            8 => 'Tháng 8',
            9 => 'Tháng 9',
            10 => 'Tháng 10',
            11 => 'Tháng 11',
            12 => 'Tháng 12'
        ];

        return $months[$monthNumber] ?? 'Tháng không hợp lệ';
    }

    /**
     * Phương thức để lấy ngày trong tuần từ số ngày trong tuần (0-6, 0 là Chủ nhật).
     *
     * @param int $dayNumber Số ngày trong tuần (từ 0 đến 6).
     * @return string Tên của ngày trong tuần hoặc 'Ngày không hợp lệ' nếu số ngày không hợp lệ.
     */
    public static function getDayOfWeek($dayNumber): string
    {
        $daysOfWeek = [
            0 => 'Chủ nhật',
            1 => 'Thứ hai',
            2 => 'Thứ ba',
            3 => 'Thứ tư',
            4 => 'Thứ năm',
            5 => 'Thứ sáu',
            6 => 'Thứ bảy'
        ];

        return $daysOfWeek[$dayNumber] ?? 'Ngày không hợp lệ';
    }

    /**
     * Phương thức để kiểm tra xem một năm có phải là năm nhuận không.
     *
     * @param int $year Năm cần kiểm tra.
     * @return bool True nếu là năm nhuận, ngược lại là false.
     */
    public static function isLeapYear($year): bool
    {
        return (($year % 4 == 0) && ($year % 100 != 0)) || ($year % 400 == 0);
    }
}