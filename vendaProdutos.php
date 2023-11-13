<?php
include_once 'setup.php';
include_once "controllers/ConfigSite.php";
include_once 'controllers/StatusVendaEnum.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Controle de Movimentação</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<?php include_once 'view/Navbar.html';
$produtoRepository = new ProdutoRepository();
$produtos = $produtoRepository->getControleProduto();
$produtoRepository->showMessage();
?>
<form action='<?php echo ConfigSite::$ROOT; ?>/vendas' method='post'>
    <h5 style="padding: 10px;">Cadastro de Venda</h5>
    <div class="row g-2">
        <div class="input-group mb-3" style="width: 26%; padding: 10px;">
            <input name="nome_cliente" type="text" step=any id="nome_cliente" class="form-control"
                   aria-label="Recipient's username"
                   aria-describedby="button-addon2" placeholder="Nome Do Cliente" required>
        </div>
        <div class="input-group mb-3 " style="width: 26%; padding: 10px;">
            <label for="data_venda" class=""></label>
            <input name="data_venda" type="date" step=any id="data_venda" class="form-control"
                   aria-label="Recipient's username"
                   aria-describedby="button-addon2" placeholder="Data da venda">
        </div>
    </div>
    <div class="input-group mb-3 " style="width: 26%; padding: 10px;">
        <select class="form-select" name="status_venda" aria-label="Default select example">
            <option selected value="0">Selecione um Status</option>
            <option value="<?php echo StatusVendaEnum::Finalizado; ?>">Finalizado</option>
            <option value="<?php echo StatusVendaEnum::Pendente; ?>">Pendente</option>
        </select>
    </div>
    <div class="row g-2" id="gerar-campos" style="display: flex; flex-flow: row;">
        <div class="input-group mb-3" id="produtos" style="width: 26%; padding: 10px;">
            <select class="form-select" name="produto[<?php echo uniqid(); ?>][nome]" id="produtor"
                    aria-label="Default select example">
                <option selected value="0">Escolha Um Produto</option>
                <?php

                foreach ($produtos['dados'] as $produto) {
                    ?>
                    <option value="<?php echo $produto["id"]; ?>"><?php echo $produto["id"] . ' - ' . $produto['nome']; ?></option>
                <?php }
                ?>
            </select>
        </div>

        <div class="input-group mb-1 " style="width: 26%; padding: 10px;">
            <input name="produto[<?php echo uniqid(); ?>][quantidade]" type="number" step=any id="quantidade_venda"
                   class="form-control"
                   aria-label="Recipient's username"
                   aria-describedby="button-addon2" placeholder="Quantidade">
        </div>
        <div class="input-group mb-1 " style="width: 26%; padding: 10px;">
            <input name="produto[<?php echo uniqid(); ?>][valor]" type="number" step=any id="valor"
                   class="form-control"
                   aria-label="Recipient's username"
                   aria-describedby="button-addon2" placeholder="Valor">
        </div>
        <div class="input-group mb-1">
            <div class="input-group-append" style="margin-left: 10px;">
                <button type="button" onclick="validator()" class="btn btn-outline-dark" id="newRow"
                        style="height: 35.27px;margin-top:9px;">+
                </button>
            </div>
        </div>

    </div>
    <div class="adiciona"></div>

    <div class="row">
        <div class="mb-4">
            <table class="table">
                <thead>
                <tr>
                    <td>Produto</td>
                    <td>Quantidade</td>
                    <td>Valor</td>
                    <td>Ações</td>
                </tr>
                </thead>
                <tbody id="items-content">
                </tbody>
            </table>
        </div>
    </div>


    <input type="submit" class="btn btn-outline-secondary" value="Enviar"
           style="width: 100px; margin-left: 5px;">
</form>
<br>

<?php include_once "JavaScript/script.html"; ?>

</body>

<script>
    function validator() {
        var select = document.getElementById('produtor');
        var produtoId = select.options[select.selectedIndex].value;
        var quantidade = document.getElementById('quantidade_venda').value;
        var valor = document.getElementById('valor').value;

        if (produtoId > 0 && quantidade > 0 && valor > 0) {
            adicionar();
        }
    }

    function adicionar() {

        var n = Math.floor(Math.random() * 11);
        var k = Math.floor(Math.random() * 1000000);
        var uniqid = n + k;

        var select = document.getElementById('produtor');
        var produtoId = select.options[select.selectedIndex].value;
        var descricaoProduto = select.options[select.selectedIndex].innerText;
        var quantidade = document.getElementById('quantidade_venda').value;
        var valor = document.getElementById('valor').value;


        var linha = "<tr id=" + uniqid + " >";
        linha += "    <td>";
        linha += "        " + descricaoProduto;
        linha += "        <input type='hidden' name='itens[" + uniqid + "][produto_id]' value='" + produtoId + "'>";
        linha += "    </td>";
        linha += "    <td>";
        linha += "        " + quantidade;
        linha += "        <input type='hidden' name='itens[" + uniqid + "][quantidade]' value='" + quantidade + "'>";
        linha += "    </td>";
        linha += "    <td>";
        linha += "        " + valor;
        linha += "        <input type='hidden' name='itens[" + uniqid + "][valor]' value='" + valor + "'>";
        linha += "    </td>";
        linha += "    <td>";
        linha += "        <button id='removeRow' data-antonio='" + uniqid + "' onclick='remover(this)' type='button' class='btn btn-danger' style='height: 35.27px;'>Remover</button>";
        linha += "    </td>";
        linha += "</tr>";

        let container = document.getElementById('items-content');
        container.insertAdjacentHTML('beforeend', linha);
    }

    function remover(elemento) {
        var id = elemento.getAttribute('data-antonio');
        var select = document.getElementById(id);
        select.remove();
    }

</script>

</html>