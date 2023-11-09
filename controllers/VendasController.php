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

    public function index($params)
    {
        $produtoRepository = new ProdutoRepository();
        $authenticator = new Authenticator();


        if (isset($params["itens"]) && isset($params["nome_cliente"])) {
            $nomeCliente = $params['nome_cliente'];
            $itens = $params['itens'];
            foreach ($itens as $chave => $item) {
                $idProduto = $item["produto_id"];
                $quantidadeVenda = $item['quantidade'];
                var_dump($idProduto);
                $dataVenda = $params['data_venda'];
                $statusVenda = $params['status_venda'];
                $quantidadeEstoque = $produtoRepository->getProduto($idProduto);
                $total = $quantidadeEstoque['estoque'] - $quantidadeVenda;
                if ($total <= 0) {
                    $mensagem = "Impossivel realizar esta ação, Verifique se o produto está em estoque para poder realizar a venda!";
                    $authenticator->notification($mensagem);
                    Navigation::navigateToBack();
                }else {
                    $total = 0;
                    $produtoRepository->storeVendas($nomeCliente, $idProduto, $dataVenda, $quantidadeVenda, $statusVenda);
                    $mensagem = "Sua venda foi realizada com sucesso!";
                    $authenticator->notification($mensagem);
                    Navigation::navigateTo("prod");
                }
            } exit;
        }



        include_once 'vendaProdutos.php';
    }

}