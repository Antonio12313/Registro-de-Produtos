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
            <option selected value="0">Status da Venda</option>
            <option value="<?php echo StatusVendaEnum::Finalizado; ?>">Finalizado</option>
            <option value="<?php echo StatusVendaEnum::Pendente; ?>">Pendente</option>
        </select>
    </div>
    <div class="row g-2" id="gerar-campos" style="display: flex; flex-flow: row;">
        <div class="input-group mb-3" style="width: 26%; padding: 10px;">
            <select class="form-select" name="produto" aria-label="Default select example">
                <option selected value="0">Produto</option>
                <?php

                foreach ($produtos['dados'] as $produto) {
                    ?>
                    <option value="<?php echo $produto["id"]; ?>"><?php echo $produto["id"] . ' - ' . $produto['nome']; ?></option>
                <?php }
                ?>
            </select>
        </div>
        <div class="input-group mb-1 " style="width: 26%; padding: 10px;">
            <input name="quantidade_venda" type="number" step=any id="quantidade_venda" class="form-control"
                   aria-label="Recipient's username"
                   aria-describedby="button-addon2" placeholder="Quantidade">

        </div>
        <div class="input-group mb-1">
            <div class="input-group-append" style="margin-left: 10px;">
                <button type="button" onclick="gerarCampo()" class="btn btn-outline-dark" id="newRow"
                        style="height: 35.27px;">+
                </button>
            </div>
            <div class="input-group-append" style="margin-left: 10px; ">
                <button id="removeRow" type="button" class="btn btn-danger" style="height: 35.27px;">Remove</button>
            </div>
        </div>

    </div>

    <div class="row g-3">
    <div class="gerar-aqui  " >

    </div></div>
    <input type="submit" class="btn btn-outline-secondary" id="button-addon2" value="Enviar"
           style="width: 9%; margin-left: 5px;">
</form>
<br>

<?php include_once "JavaScript/script.html"; ?>

</body>

<script>
    function gerarCampo() {
        var n = Math.floor(Math.random() * 11);
        var k = Math.floor(Math.random() * 1000000);
        var uniqid = n + k;

        console.log(uniqid)

        let div = "<div id='gerar" + uniqid + "'> </div>";

        let divPai = document.querySelector('#gerar-campos').innerHTML
        let gerar = document.querySelector('.gerar-aqui');
        gerar.innerHTML += div;

        document.querySelector('#gerar'+uniqid).innerHTML = divPai

    }

</script>
</html>