<?php
namespace app\services;

use PDO;

/**
 * Class Db
 * @package app\services
 */
class Db
{
    public static function connect()
    {
        return new PDO('mysql:host=localhost;dbname=pdpunit', "root", "root");
    }
}
