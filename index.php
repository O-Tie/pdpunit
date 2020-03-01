<?php

require_once 'helpers/FileManager.php';
require_once 'services/DateService.php';

use services\DateService;
use helpers\FileManager;

$data = (new DateService())->getData();
FileManager::exportCsv($data);

?>