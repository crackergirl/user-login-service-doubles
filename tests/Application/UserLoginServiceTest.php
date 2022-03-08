<?php

declare(strict_types=1);

namespace UserLoginService\Tests\Application;

use PHPUnit\Framework\TestCase;
use UserLoginService\Application\UserLoginService;
use UserLoginService\Domain\User;
use UserLoginService\Tests\Doubles\SpySessionManager;
use UserLoginService\Tests\Doubles\StubSessionManager;
use UserLoginService\Tests\Doubles\FakeSessionManager;
use UserLoginService\Tests\Doubles\DummySessionManager;

final class UserLoginServiceTest extends TestCase
{
    /**
     * @test
     */
    public function userIsLoggedInManually()
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
    public function userIsLoggedInExternalService(){
        $userLoginService = new UserLoginService(new FakeSessionManager());

        $loginSession = $userLoginService->login("Paula", "1234");

        $this->assertEquals("Login correcto", $loginSession);

    }
    /**
     * @test
     */
    public function userIsNoLoggedInExternalService(){
        $userLoginService = new UserLoginService(new FakeSessionManager());

        $loginSession = $userLoginService->login("", "");

        $this->assertEquals($userLoginService::LOGIN_INCORRECTO, $loginSession);

    }

    /**
     * @test
     */
    public function userNotLogoutUserNotBeingLoggedIn(){

        $user = new User("Alex");
        $userLoginService = new UserLoginService(new DummySessionManager());

        $logoutResponse = $userLoginService->logout($user);

        $this->assertEquals($userLoginService::USUARIO_NO_LOGEADO, $logoutResponse);
    }

    /**
     * @test
     */
    public function userLogout(){

        $user = new User("Alex");
        $sessionManager = new SpySessionManager();
        $userLoginService = new UserLoginService($sessionManager);
        $userLoginService->manualLogin($user);

        $logoutResponse = $userLoginService->logout($user);

        $sessionManager->verifyLogoutCalls(1);

        $this->assertEquals($userLoginService::OK, $logoutResponse);
    }

    /**
     * @test
     */
    public function userNotSecurelyLoggedInIfUserExistInExternalService(){
        $sessionManager = new SpySessionManager();
        $userLoginService = new UserLoginService($sessionManager);
        $user = new User("Alex");

        $securityloginSession = $userLoginService->secureLogin( $user);

        $this->assertEquals($userLoginService::OK, $securityloginSession );

    }


}
