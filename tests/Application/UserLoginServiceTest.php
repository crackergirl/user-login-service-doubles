<?php

declare(strict_types=1);

namespace UserLoginService\Tests\Application;

use PHPUnit\Framework\TestCase;
use UserLoginService\Application\UserLoginService;
use UserLoginService\Domain\User;
use UserLoginService\Infrastructure\FacebookSessionManager;
use UserLoginService\Tests\Doubles\StubSessionManager;

final class UserLoginServiceTest extends TestCase
{
    /**
     * @test
     */
    public function userIsLoggedIn()
    {
        $userLoginService = new UserLoginService(new StubSessionManager());
        $user = new User("Alex");
        $expectedLoggedUsers = [$user];

        $userLoginService->manualLogin($user);

        $this->assertEquals($expectedLoggedUsers, $userLoginService->getLoggedUsers());
    }

    /**
     * @test
     */
    public function countesExternalSession(){
        $userLoginService = new UserLoginService(new StubSessionManager());

        $countExternalSession = $userLoginService->countExternalSession();

        $this->assertEquals(2, $countExternalSession);

    }

    /**
     * @test
     */
    public function userIsLoggedInAPIFacebook(){
        $userLoginService = new UserLoginService(new FacebookSessionManager());

        $loginSession = $userLoginService->login("Paula", "1234");

        $this->assertEquals("Login correcto", $loginSession);

    }






}
