<?php
include_once 'ProdutoRepository.php';
include_once 'setup.php';
include_once 'Controller.php';

class CadastroUserController
{
    public function index($params)
    {
        $produtoRepository = new ProdutoRepository();
        $mensagem = "";

        if (!empty($params["entrar"]) && !empty($params["login_cadastro"]) && !empty($params["senha_cadastro"])) {

            $nome = $params["nome"];
            $login = $params["login_cadastro"];
            $senha = md5($params["senha_cadastro"]);
            $existe = $produtoRepository->verificarDisponibilidade($login);
            if ($existe) {
                $cadastro = $produtoRepository->storeUsuario($nome, $login, $senha);
                if ($cadastro) {
                    $mensagem = "Seu usuário foi cadastrado com sucesso!";
                }
            } else {
                $mensagem = "Esse email já existe!";

            }
        }

        include_once "cadastroUsuario.php";
    }
}