<?php

namespace UserLoginService\Tests\Doubles;

use PHPUnit\Util\Exception;
use UserLoginService\Application\SessionManager;

class SpySessionManager implements SessionManager
{
    private int $calls = 0;

    public function getSessions(): int
    {
        // TODO: Implement getSessions() method.
    }

    public function login(string $userName, string $password): bool
    {
        // TODO: Implement login() method.
    }

    public function logout(string $userName): void
    {
        $this->calls++;

    }
    public function verifyLogoutCalls(int $expectedCalls): bool
    {
        if ($this->calls !== $expectedCalls){
            throw new Exception("");
        }
        return true;

    }

    public function secureLogin(string $getUserName)
    {
        // TODO: Implement secureLogin() method.
    }
}