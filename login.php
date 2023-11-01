<!doctype html>
<html lang="br">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="login" class="" method="post">
    <div class="center" style=" border: 1px solid; margin: 40px; width: 15%; padding: 10px;">
        <div class="center">
            <label for="login" class="">Login:</label>
            <input type="email" name="login" id="login" required>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
            <input type="submit" style="margin: 10px; margin-left: 0px" name="entrar">
        </div>
        <a href="cadastroUser">Cadastre-se</a>
        <?php
        $produtorepository = new ProdutoRepository();
        $produtorepository->showMessage();
        ?>
    </div>
</form>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</html>
