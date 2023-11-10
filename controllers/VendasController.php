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

        $codVenda = uniqid();
        if (isset($params["itens"]) && isset($params["nome_cliente"])) {
            $nomeCliente = $params['nome_cliente'];
            $itens = $params['itens'];
            $dataVenda = $params['data_venda'];
            $statusVenda = $params['status_venda'];

            $validator = $produtoRepository->stockValidator($itens);
            if ($validator) {
                $uniqid = $produtoRepository->getUniqId();
                $produtoRepository->storeCliente($nomeCliente, $dataVenda, $statusVenda,$uniqid);
                foreach ($itens as $chave => $item) {
                    $idProduto = $item["produto_id"];
                    $quantidadeVenda = $item['quantidade'];
                    $produtoRepository->storeVendas($nomeCliente, $idProduto, $quantidadeVenda);
                }   $mensagem = "Sua venda foi realizada com sucesso!";
                    $authenticator->notification($mensagem);
                    Navigation::navigateTo('prod');

            }else {
                $mensagem = "Impossivel realizar esta ação, Verifique se o produto está em estoque para poder realizar a venda!";
                $authenticator->notification($mensagem);
                Navigation::navigateToBack();
            }

        }

        include_once 'vendaProdutos.php';
    }


}

