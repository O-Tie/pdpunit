<?php
namespace app\models;

use app\exceptions\AgeException;
use app\services\UserService;

/**
 * Class User
 * @package app\models
 */
class User
{
    private $name;
    private $email;
    private $pass;
    private $age;
    private $userService;

    /**
     * User constructor.
     * @param $name
     * @param $email
     * @param $pass
     * @param $age
     */
    public function __construct($name = null, $email = null, $pass = null, $age = null)
    {
        $this->name = $name;
        $this->email = $email;
        $this->pass = $pass;
        $this->age = $age;
        $this->userService = new UserService();
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @param mixed $pass
     */
    public function setPass($pass): void
    {
        $this->pass = $pass;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age): void
    {
        $this->age = $age;
    }

    /**
     * @param $age
     * @return bool
     * @throws AgeException
     */
    public function getAgeException($age)
    {
        if ($this->age !== $age) {
            throw new AgeException('Age value is incorrect');
        }

        return true;
    }

    /**
     * @return string
     */
    public function getAdmin()
    {
        return $this->userService->getAdmin();
    }

    /**
     * @return string
     */
    private function getPrivateData()
    {
        return 'privateData';
    }
}
