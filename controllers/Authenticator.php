<?php

class Authenticator
{

    public function userIsLogged()
    {
        if (isset($_SESSION['logado'])) {
            return true;
        } else {
            return false;
        }
    }

    public function getEmailUserLogged()
    {
        return $_SESSION['email'];
    }

    public function userLogout()
    {
        session_unset();
    }

    public function logUser($email)
    {
        $_SESSION['email'] = $email;
        $_SESSION['logado'] = true;
        $_SESSION['mensagem'] = "";
    }

    public function getMessage()
    {
        return $_SESSION['mensagem'];
    }

    public function notification($message)
    {
        $_SESSION['mensagem'] = $message;
    }

}