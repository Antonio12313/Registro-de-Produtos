<?php
include_once 'setup.php';
include_once "controllers/ConfigSite.php";
include_once 'controllers/EstoqueEnum.php';
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
<form action='<?php echo ConfigSite::$ROOT; ?>/prod/controleEstoque' method='post'>
    <h5 style="padding: 10px;">Registre sua movimentação</h5>
    <div class="input-group mb-3 " style="width: 26%; padding: 10px;">
        <select class="form-select" name="produto" aria-label="Default select example" style="text-align: 10px;">
            <option selected value="0">Produto</option>
            <?php

            foreach ($produtos['dados'] as $produto) {
                ?>
                <option value="<?php echo $produto["id"]; ?>"><?php echo $produto["id"] . ' - ' . $produto['nome']; ?></option>
            <?php }
            ?>
        </select>
    </div>
    <div class="input-group mb-3 " style="width: 26%; padding: 10px;">
        <input name="quantidade" type="number" step=any id="quantidade" class="form-control"
               aria-label="Recipient's username"
               aria-describedby="button-addon2" placeholder="Quantidade">
    </div>
    <div class="input-group mb-3 " style="width: 26%; padding: 10px;">
        <select class="form-select" name="tipo_movimentacao" aria-label="Default select example">
            <option selected value="0">Escolha Uma Opção</option>
            <option value="<?php echo EstoqueEnum::Entrada; ?>">Entrada</option>
            <option value="<?php echo EstoqueEnum::Saida; ?>">Saída</option>
        </select>
        <input type="submit" class="btn btn-outline-secondary" id="button-addon2" value="Enviar">
    </div>

</form>
<br>

<?php include_once "JavaScript/script.html"; ?>

</body>
</html>