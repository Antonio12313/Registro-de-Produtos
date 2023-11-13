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

    public function produtos($params){
        $produtoRepository = new ProdutoRepository();
        $produtos = $produtoRepository->getProdutoPedido($params['q']);

        foreach ($produtos['dados'] as $produto) {
            echo "<tr style='font-size: 1rem;'><td><strong>".$produto['nome']."</strong></td>\n<td>".$produto["quantidade_venda"]."</td></tr>";
        }

    }

}