<?php

require_once 'helpers/FileManager.php';
require_once 'services/DateService.php';

$dates = (new \services\FileService\DateService())->getSalaryDates();

$a = $dates;
?>