<?php
include_once 'ProdutoRepository.php';
include_once 'setup.php';
include_once 'Controller.php';
include_once 'controllers/Authenticator.php';
include_once 'controllers/EstoqueEnum.php';
include_once 'utils/Navigation.php';
class ProdController extends Controller
{

    public $needAuthentication = true;

    public function index($params)
    {
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


        $total_no_of_pages = $produtoRepository->paginacao($total_records_per_page);
        $second_last = $total_no_of_pages - 1;
        $produtos = $produtoRepository->getProdutos($offset, $total_records_per_page, $params);

        include_once "indexbkp.php";
    }

    public function edit($id, $params)
    {
        $produtoRepository = new ProdutoRepository();
        $authenticator = new Authenticator();

        $user = $authenticator->getEmailUserLogged();
        if (isset($id) && isset($params['nome'])) {
            $produtoRepository->updateProduto($id, $params, $user);
            $mensagem = "O seu Produto foi atualizado";
            $authenticator->notification($mensagem);
            Navigation::navigateTo("prod");
            exit;
        }

        include_once "editarproduto.php";


    }

    public function cadastro($params)
    {
        $produtoRepository = new ProdutoRepository();
        $authenticator = new Authenticator();
        if (!empty($params['nome'])) {
            $nome = $params['nome'];
            $email = $authenticator->getEmailUserLogged();

            $getuserId = $produtoRepository->getUserID($email);
            $id = $getuserId['id'];

            $store = $produtoRepository->storeProduto($nome, $id);
            $mensagem = "Seu Produto foi cadastrado com sucesso!";
            $authenticator->notification($mensagem);
            Navigation::navigateTo("prod");
            exit;
        }
        include_once 'cadastroProduto.php';
    }

    public function delete($id)
    {
        $produtoRepository = new ProdutoRepository();
        $authenticator = new Authenticator();

        session_start();

        if (isset($id)) {
            $delete = $produtoRepository->deleteProduto($id);
            $mensagem = "Seu Produto foi deletado sucesso!";
            $message = $authenticator->notification($mensagem);
            Navigation::navigateTo("prod");
            exit;
        }
        include_once "indexbkp.php";
    }

    public function controleEstoque($params)
    {
        $produtoRepository = new ProdutoRepository();
        $authenticator = new Authenticator();
        if (!empty($params['produto']) && isset($params['tipo_movimentacao']) && isset($params['quantidade'])) {
            $idProdutoMovimentacao = $params['produto'];
            $quantidade = $params['quantidade'];
            $tipoMovimentacao = $params['tipo_movimentacao'];

            $email = $authenticator->getEmailUserLogged();
            $getuserId = $produtoRepository->getUserID($email);
            $id = $getuserId['id'];

            $quantidadeEstoque = $produtoRepository->getProduto($idProdutoMovimentacao);
            $total =  $quantidadeEstoque['estoque'] - $quantidade;
            if($total < 0 && $tipoMovimentacao == 2 ){
                $mensagem = "Impossivel realizar esta ação, Verifique se o produto está em estoque para poder realizar a saída!";
                $authenticator->notification($mensagem);
                Navigation::navigateToBack();
            }else{
                $produtoRepository->storeMovimentacao($idProdutoMovimentacao,$quantidade,$tipoMovimentacao);
                $mensagem = "Sua movimentação foi cadastrado com sucesso!";
                $authenticator->notification($mensagem);
                Navigation::navigateTo("prod");
            }
            exit;
        }
        include_once 'controleEstoque.php';
    }

}
