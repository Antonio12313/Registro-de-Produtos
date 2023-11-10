<!doctype html>
<html lang="br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<?php
include_once 'view/Navbar.html';
include_once 'controllers/ConfigSite.php';
?>
<br>

<form action="<?php echo ConfigSite::$ROOT; ?>pedido" method="post" class="row g-2">
    <div class="table-reponsive">
        <table class="table table-bordered table-striped" style="text-align: center">
            <thead class="table" style="background-color: #739072">

            <tr style="color: white;font-size: 1rem;">
                <td>Código Do Pedido</td>
                <td>Cliente ☼</td>
                <td>Data De Venda</td>
                <td>Status Da Venda</td>
                <td>Opções</td>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($produtos['dados'] as $produto) {
                ?>
                <tr style="font-size: 1rem;">
                    <td><strong> <?php echo $produto["id"]; ?></strong></td>
                    <td><?php echo $produto["nome"]; ?></td>
                    <td><?php echo $produtorepository->numberFormat($produto["estoque"]); ?></td>
                    <td><?php echo $produto["name"]; ?></td>
                    <td><?php echo $produto["created_at"] ?></td>
                    <td><?php echo $produto["updated_at"] ?></td>
                    <td>
                        <style>
                            .btn.btn-outline-success:hover {
                                background-color: #739072;
                                color: white;

                            }

                            .btn.btn-outline-danger:hover {
                                background-color: rgb(220, 76, 100);
                                color: white;
                            }
                        </style>
                        <a href="<?php echo ConfigSite::$ROOT; ?>/prod/edit/<?php echo $produto["id"]; ?>"
                           class="btn btn-outline-success" style="border-color: #739072;" tabindex="-1" role="button"
                           aria-disabled="true">Editar</a>
                        <a href="<?php echo ConfigSite::$ROOT; ?>/prod/delete/<?php echo $produto["id"]; ?>"
                           type="button"
                           class="btn btn-outline-danger btn-delete">
                            Deletar
                        </a>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</form>
</section>

</body>
<?php include_once "JavaScript/script.html"; ?>

</html>