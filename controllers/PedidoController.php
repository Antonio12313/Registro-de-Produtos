<?php
include_once 'ProdutoRepository.php';
include_once 'setup.php';
include_once 'Controller.php';
include_once 'controllers/Authenticator.php';
include_once 'controllers/EstoqueEnum.php';
include_once 'utils/Navigation.php';

class PedidoController extends Controller
{
    public $needAuthentication = true;

    public function index($params){



        include_once "pedidos.php";
    }

}