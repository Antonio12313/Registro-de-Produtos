<!doctype html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="UTF-8" >
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php include_once 'view/Navbar.html'; ?>
<?php
$url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
$id = $url[2];
?>
<form action="" method='post'>
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <?php
    $produtoRepository = new ProdutoRepository();
    $produto = $produtoRepository->getProduto($id);
    ?>
    <input type="text" name="nome" value="<?php echo $produto["nome"]; ?>">
    <button type="submit">Atualizar</button>
</form>
<br>
<a href="http://localhost/cadastro-produtos/prod">Voltar</a>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>
