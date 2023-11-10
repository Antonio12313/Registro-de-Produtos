<?php
include_once 'ProdutoRepository.php';
include_once 'setup.php';
include_once 'controllers/Controller.php';
include_once 'controllers/Authenticator.php';
include_once 'controllers/EstoqueEnum.php';
include_once 'utils/Navigation.php';

echo "opa";
echo "<td>";

echo  " <strong>";
        $produtoRepository = new ProdutoRepository();
        $teste = $produtoRepository->getProdutoPedido($_GET['q']);
        echo $teste['nome'];

        echo  "</strong>";
echo "</td>";
echo "<td>";
echo $teste["quantidade_venda"];
echo"</td> ";
