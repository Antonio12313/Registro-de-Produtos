<?php
include_once 'ProdutoRepository.php';
include_once 'setup.php';
include_once 'Controller.php';
include_once 'Authenticator.php';

class LoginController extends Controller
{
    public function index($params)
    {
        $produtoRepository = new ProdutoRepository();
        $authenticator = new Authenticator();
        if ($authenticator->userIsLogged()) {
            header("Location: prod");
        }

        $mensagemLogin = "";
        $authenticator->notification($mensagemLogin);
        if (isset($params['entrar'])) {
            $login = $params['login'];
            $senha = md5($params['senha']);
            $loginValidar = $produtoRepository->getLogin($login, $senha);

            if ($loginValidar) {
                $authenticator->logUser($login);
                header("Location: prod");
                exit();
            } else {
                $mensagemLogin = "Login ou senha incorreto!";
                $authenticator->notification($mensagemLogin);
            }
        }
        include_once "login.php";
    }
}