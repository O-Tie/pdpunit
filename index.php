<?php


require_once 'helpers/FileManager.php';
require_once 'services/FileService.php';

const TOTAL_MONTH = 12;
const TOTAL_WEEK_DAYS = 7;

$current_month = date('m');
$current_year = date('Y');

$d_daysinmonth = date('t', mktime(0,0,0, (int) $current_month,1, (int) $current_year));

for ($day = $d_daysinmonth - TOTAL_MONTH; $day < $d_daysinmonth; $day++) {

}


$a = $d_daysinmonth;

?>