<!doctype html>
<html lang="br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<form action="login" class="" method="post">
    <div class="center" style=" border: 1px solid; margin: 40px; width: 25%; padding: 10px;">
        <div class="mb-3">
            <label for="login" class="form-label">Faça o Login</label>
            <input type="email" class="form-control" name="login" id="login" required placeholder="nome@mail.com">
            <label for="senha" class="form-label">Password</label>
            <input type="password" id="senha" class="form-control" name="senha" aria-describedby="passwordHelpBlock">
        </div>
        <div class="position-relative">
            <style>
                .btn.btn-outline-primary:hover {
                    background-color: #386bc0;
                    color: white;
                }
            </style>
            <input type="submit" class="btn btn-outline-primary" style="margin: 10px; margin-left: 0px" name="entrar"
                   value="Entrar">
            <div class="position-absolute top-50 start-50 translate-middle" style="height: 1.5rem;">
                <a href="cadastroUser">Cadastre-se</a>
                <?php
                $produtorepository = new ProdutoRepository();
                $produtorepository->showMessage();
                ?>
            </div>
        </div>
    </div>
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        rel="stylesheet"/>
<link
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
        rel="stylesheet"/>
<link
        href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.css"
        rel="stylesheet"/>
<script
        type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.js"
></script>
</body>

</html>
