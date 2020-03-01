<?php
namespace helpers;

/**
 * Class FileManager
 * @package helpers\FileManager
 */
class FileManager
{
    /**
     * @param array $data
     */
    public static function exportCsv(array $data)
    {
        try {
            $fp = fopen('file.csv', 'w');
            foreach ($data as $fields) {
                fputcsv($fp, $fields);
            }
            fclose($fp);
        } catch (\Exception $e) {
            error_log('message: ' . $e->getMessage());
        }
    }
}
