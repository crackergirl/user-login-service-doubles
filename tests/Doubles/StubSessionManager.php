<?php

namespace UserLoginService\Tests\Doubles;
use UserLoginService\Application\SessionManager;

class StubSessionManager implements SessionManager
{
    public function login(string $userName, string $password): bool
    {
        return true;
    }

    public function getSessions(): int
    {
        return 2;
    }


    public function logout(string $userName): void
    {
        // TODO: Implement logout() method.
    }

    public function secureLogin(string $getUserName)
    {
        // TODO: Implement secureLogin() method.
    }
}