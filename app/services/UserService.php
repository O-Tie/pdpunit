<?php

namespace app\services;

/**
 * Class UserService
 * @package app\services
 */
class UserService
{
    /**
     * @return array
     */
    public function getUsers(): array
    {
        $pdo = Db::connect();
        $stmt = $pdo->query('SELECT * FROM users');
        $users = $stmt->fetchAll();
        return $users;
    }

    /**
     * @return string
     */
    public function getAdmin(): string
    {
        return 'Admin';
    }
}
