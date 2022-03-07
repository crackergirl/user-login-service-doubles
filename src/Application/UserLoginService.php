<?php

namespace UserLoginService\Application;
use UserLoginService\Application\SessionManager;
use UserLoginService\Domain\User;

class UserLoginService
{
    private array $loggedUsers = [];
    private SessionManager $sessionManager;


    public function __construct(SessionManager $sessionManager)
    {
        $this->sessionManager = $sessionManager;
    }


    public function manualLogin(User $user): void
    {
        if ($user->getUserName() != ""){
            $this->loggedUsers[] = $user;
        }

    }

    public function getLoggedUsers():array
    {
        return  $this->loggedUsers;
    }
    public function countExternalSession(): int{

        return $this->sessionManager->getSessions();


    }
    public function login(string $userName, string $password):string{
        if ($this->sessionManager->login($userName, $password) == true){
            $user = new User($userName);
            $this->manualLogin($user);

            return "Login correcto";
        }

        return "Login incorrecto";
    }

}