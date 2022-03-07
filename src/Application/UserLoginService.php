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
            #array_push($this->loggedUsers,$user);
        }

    }

    public function getLoggedUsers():array
    {
        return  $this->loggedUsers;
    }
    public function countExternalSession(): int{
        #$sessionManager = new SessionManager();
        return $this->sessionManager->getSessions();


    }

}