<?php
namespace helpers;

/**
 * Class FileManager
 * @package helpers\FileManager
 */
class FileManager
{
    protected const DEFAULT_FILE_NAME = 'export';
    protected const PATH = 'output/';

    /**
     * Returns date of generated file from .sh
     * @return string
     */
    protected static function getFileDate(): string
    {
        return date('d-m-Y h:i:s');
    }
    /**
     * @param array $params
     * @return string
     */
    protected static function getFileName(array $params)
    {
        return ($params[1] ?? self::DEFAULT_FILE_NAME . '-' . self::getFileDate()) . '.csv';
    }

    /**
     * @param array $data
     * @param array $params
     */
    public static function exportCsv(array $data, array $params)
    {
        $fileName = self::getFileName($params);
        try {
            $fp = fopen(self::PATH . $fileName, 'w');
            foreach ($data as $fields) {
                fputcsv($fp, $fields);
            }
            fclose($fp);
        } catch (\Exception $e) {
            error_log('message: ' . $e->getMessage());
        }
    }
}
