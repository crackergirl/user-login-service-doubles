<?php

namespace UserLoginService\Application;
use PHPUnit\Exception;
use UserLoginService\Application\SessionManager;
use UserLoginService\Domain\User;

class UserLoginService
{
    const LOGIN_CORRECTO = "Login correcto";
    const LOGIN_INCORRECTO = "Login incorrecto";
    const USUARIO_NO_LOGEADO = "Usuario no logeado";
    const OK = "Ok";

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

            return self::LOGIN_CORRECTO;
        }

        return self::LOGIN_INCORRECTO;
    }

    public function logout(User $user):string
    {
        if (!in_array($user,$this->getLoggedUsers())){
            return self::USUARIO_NO_LOGEADO;
        }
        $this->sessionManager->logout($user->getUserName());
        return self::OK;
    }

    public function secureLogin(User $user)
    {
        try{
            $this->sessionManager->secureLogin($user->getUserName());
        }catch (Exception $exception){
            if($exception->getMessage() === "User does not exist"){
                return "Usuario no existe";
            }
        }

        return 'Ok';

    }

}