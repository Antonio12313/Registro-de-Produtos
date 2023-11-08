<?php
include_once 'ProdutoRepository.php';
include_once 'setup.php';
include_once 'Controller.php';
include_once 'controllers/Authenticator.php';
include_once 'controllers/EstoqueEnum.php';
include_once 'utils/Navigation.php';


class VendasController extends Controller
{
    public $needAuthentication = true;

    public function index($params){
        $produtoRepository = new ProdutoRepository();
        $authenticator = new Authenticator();

        if(isset($params['produto']) && isset($params['quantidade_venda'])){
            $nomeCliente = $params['nome_cliente'];
            $idProduto =$params['produto'];
            $dataVenda =$params['data_venda'];
            $quantidadeVenda = $params['quantidade_venda'];
            $statusVenda =$params['status_venda'];

            $quantidadeEstoque = $produtoRepository->getProduto($idProduto);
            $total =  $quantidadeEstoque['estoque'] - $quantidadeVenda;
            if($total <= 0 ){
                $mensagem = "Impossivel realizar esta ação, Verifique se o produto está em estoque para poder realizar a venda!";
                $authenticator->notification($mensagem);
                Navigation::navigateToBack();

            }else{
                $produtoRepository->storeVendas($nomeCliente,$idProduto,$dataVenda,$quantidadeVenda,$statusVenda);
                $mensagem = "Sua venda foi realizada com sucesso!";
                $authenticator->notification($mensagem);
                Navigation::navigateTo("prod");
            }exit;
        }

        include_once 'vendaProdutos.php';
    }

}