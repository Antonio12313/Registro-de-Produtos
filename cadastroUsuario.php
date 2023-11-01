<!doctype html>
<html>
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
<form action="cadastroUser" class="" method="post">
    <div class="center" style=" border: 1px solid; margin: 40px; width: 15%; padding: 10px;">
        <h5>Realize o seu cadastro</h5>
        <div class="center">
            <label for="nome" class="">Nome:</label>
            <input type="text" name="nome" id="nome" required>
            <label for="login_cadastro" class="">Email:</label>
            <input type="email" name="login_cadastro" id="login_cadastro" required>
            <label for="senha_cadastro">Senha:</label>
            <input type="password" id="senha_cadastro" name="senha_cadastro" minlength="8" required>
            <input type="submit" style="margin: 10px; margin-left: 0px" name="entrar">
        </div>
        <a href="login">Tela de login</a>

    </div>
</form>
</body>
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
</html>