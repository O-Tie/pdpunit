<?php
ini_set('display_errors', false);
ini_set('error_log', 'logs/errors.log');

require_once 'helpers/FileManager.php';
require_once 'services/DateService.php';

use services\DateService;
use helpers\FileManager;

$data = (new DateService())->getData();
FileManager::exportCsv($data, $argv);
