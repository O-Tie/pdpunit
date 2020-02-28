<?php
namespace helpers\FileManager;

/**
 * Class FileManager
 * @package helpers\FileManager
 */
class FileManager
{
    public static function createCsv($list = null)
    {
        $list = array (
            array('Month', 'Salary Date', 'Bonus Date'),
            array('123', '456', '789'),
            array('"aaa"', '"bbb"')
        );

        $fp = fopen('file.csv', 'w');

        foreach ($list as $fields) {
            fputcsv($fp, $fields);
        }

        fclose($fp);
    }
}
