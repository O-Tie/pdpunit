<?php
namespace helpers;

/**
 * Class FileManager
 * @package helpers\FileManager
 */
class FileManager
{

    public static function exportCsv($data)
    {
        $fp = fopen('file.csv', 'w');

        foreach ($data as $fields) {
            fputcsv($fp, $fields);
        }

        fclose($fp);
    }
}
