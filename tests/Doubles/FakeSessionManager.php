<?php

namespace UserLoginService\Tests\Doubles;

use UserLoginService\Application\SessionManager;

class FakeSessionManager implements SessionManager
{

    public function getSessions(): int
    {
        // TODO: Implement getSessions() method.
    }

    public function login(string $userName, string $password): bool
    {
       return $userName === "Paula" and $password === "1234";
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