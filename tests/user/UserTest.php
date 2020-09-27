<?php

use PHPUnit\Framework\TestCase;
use app\models\User;
use app\exceptions\AgeException;
use app\services\UserService;

/**
 * Class UserTest
 */
class UserTest extends TestCase
{
    private $user;
    private $userService;

    /**
     * will run before test
     */
    protected function setUp(): void
    {
        $this->user = new User();
        $this->user->setAge(30);
        $this->userService = $this->createMock(UserService::class);
    }

    /**
     * Simple test
     * Compare values of 2 args
     */
    public function testAge1()
    {
        /* assertSame() method compare data and type */
        $this->assertEquals(30, $this->user->getAge());
        return 30;
    }

    /**
     * Test with provider
     * Compare values of 2 args
     * @dataProvider userProvider
     * @param $age
     */
    public function testAge2($age)
    {
        $this->assertEquals($age, $this->user->getAge());
    }

    /**
     * @return array
     */
    public function userProvider()
    {
        return [
            //'fail1' => [1], /* Could be array without key -> 'fail1', like [1] */
            //'fail2' => [2],
            'correct' => [30]
        ];
    }

    /**
     * Test with depends
     * @param $age
     * @depends testAge1
     */
    public function testAge3($age)
    {
        $this->assertEquals($age, $this->user->getAge());
    }

    /**
     * @throws AgeException
     */
    public function testAgeBool()
    {
        $this->assertIsBool($this->user->getAgeException(30));
    }

    /**
     * @throws AgeException
     */
    public function testAgeException()
    {
        $this->expectException(AgeException::class);
        $this->user->getAgeException(31);
    }

    /** Test with private method
     * @throws ReflectionException
     */
    public function testPrivateData()
    {
        $method = new ReflectionMethod(User::class, 'getPrivateData');
        if ($method->isPrivate()) {
            $method->setAccessible(true);
        }
        $privateData = $method->invoke(new User());
        $this->assertSame('privateData', $privateData);
    }

    /**
     * Test stub
     */
    public function testMock()
    {
        $this->userService->method('getAdmin')->willReturn('Admin');
        $this->assertSame('Admin', $this->user->getAdmin());
    }

    /**
     * like destructor, need unset variables this
     */
    protected function tearDown(): void
    {
        $this->user = null;
        $this->userService = null;
    }
}
