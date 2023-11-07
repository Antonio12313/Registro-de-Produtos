<?php
include_once 'setup.php';
include_once "controllers/ConfigSite.php";
include_once 'view/Navbar.html';
include_once 'controllers/EstoqueEnum.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastro de Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<?php
?>
<form action='<?php echo ConfigSite::$ROOT; ?>/prod/cadastro' method='post'>
    <h5 style="padding: 10px;">Cadastre o Seu produto</h5>
    <div class="input-group mb-3 " style="width: 25%; padding: 10px;">
        <input name="nome" type="text" id="nome" class="form-control" aria-label="Recipient's username"
               aria-describedby="button-addon2" placeholder="Produto">
    </div>

</form>
<br>

<?php include_once "JavaScript/script.html"; ?>

</body>
</html>