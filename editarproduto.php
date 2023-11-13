<!doctype html>
<html lang="br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<?php include_once 'view/Navbar.html';
include_once 'controllers/ConfigSite.php'; ?>
<?php
$url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
$id = $url[2];
?>

<form action="" method='post'>

    <input type="hidden" name="id" value="<?php echo $id; ?>">

    <h5 style="margin: 10px;">Edite o Seu Produto:</h5>
    <?php
    $produtoRepository = new ProdutoRepository();
    $produto = $produtoRepository->getProduto($id);
    ?>
    <div class="input-group mb-3 " style="width: 25%; padding: 10px;">
        <input type="text" class="form-control" name="nome" value="<?php echo $produto["nome"]; ?>"
               aria-label="Recipient's username" aria-describedby="button-addon2">
        <button class="btn btn-outline-secondary" type="submit" id="button-addon2" style="color: black;">Atualizar</button>
    </div>


    </div>
</form>
<a href="<?php echo ConfigSite::$ROOT; ?>/prod" type="submit" class="btn btn-outline-success mb-3"
   style="border-color: #739072; margin: 10px; ">voltar
</a>

<?php include_once "JavaScript/script.html"; ?>

</body>


</html>
