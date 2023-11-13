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
        $produtoRepository = new ProdutoRepository();

        if (isset($params['page_no']) && $params['page_no'] != "") {
            $page_no = $params['page_no'];
        } else {
            $page_no = 1;
        }
        $total_records_per_page = 8;

        $offset = ($page_no - 1) * $total_records_per_page;
        $previous_page = $page_no - 1;
        $next_page = $page_no + 1;
        $adjacents = "2";


        $total_no_of_pages = $produtoRepository->paginacaoPedido($total_records_per_page);
        $second_last = $total_no_of_pages - 1;
        $pedidos = $produtoRepository->getPedidos($offset, $total_records_per_page);


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