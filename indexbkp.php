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
<style>
    .row.g-2 {
        justify-content: end;
        margin-bottom: -13px;
    }
</style>
<section>
    <form class="row g-2" action="<?php echo ConfigSite::$ROOT; ?>/prod/" method="post" style="">
        <h2 class="col-auto" style="margin-right: 36rem;">Inventário</h2>
        <div class="col-auto">
            <label for="nome" class="visually-hidden">Produto</label>
            <input type="text" class="form-control" placeholder="Pesquise o produto" aria-label="First name"
                   name="nome_filtro" value="<?php echo($produtos['filtros']['nome_filtro'] ?? ""); ?>"
                   id="nome">
        </div>
        <div class="col-auto">
            <label for="user" class="visually-hidden">Nome</label>
            <input type="text" class="form-control" id="user" name="nome_user" placeholder="Pesquise o usuário"
                   value="<?php echo($produtos['filtros']['nome_user'] ?? "") ?>">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-outline-success mb-3" value="Buscar" name="buscar"
                    style="border-color: #739072;">Buscar
            </button>
        </div>
    </form>
</section>
<?php

$produtorepository = new ProdutoRepository();
$produtorepository->showMessage();
?>

<section>
    <form action="<?php echo ConfigSite::$ROOT; ?>prod/" method="post" class="row g-2">
        <table class="table table-bordered table-striped" style="text-align: center">
            <thead class="table" style="background-color: #739072">

            <tr style="color: white;font-size: 1rem;">
                <td>Id</td>
                <td>Produtos ☼</td>
                <td>Quantidade Em Estoque</td>
                <td>Usuário</td>
                <td>Foi criado em</td>
                <td>Ultima Modificação</td>
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
    </form>
</section>
<form action="<?php echo ConfigSite::$ROOT; ?>/prod" method="post">
    <div class="center" style="text-align: center;">
        <?php if (empty($_REQUEST["nome_filtro"])) {
            ?><strong>Página <?php echo $page_no . " de " . $total_no_of_pages; ?></strong><?php
            include_once 'paginacao-estrutura.php';
        } ?>
    </div>
</form>
<br>

<div class="modal" id="exampleCentralModal1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content text-center">
            <div class="modal-header bg-danger text-white d-flex justify-content-center">
                <h5 class="modal-title" id="exampleModalLabel" style="font-size: 1.8rem;">Deletar
                    Produto</h5>
            </div>
            <div class="modal-body">
                <i class="fas fa-times fa-3x text-danger"></i>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" id="btn-confirm-delete" class="btn btn-outline-danger" data-bs-dismiss="modal">
                    Sim
                </button>

                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Não</button>
            </div>
        </div>
    </div>
</div>
</body>

<?php include_once "JavaScript/script.html"; ?>
<script>
    document.addEventListener("DOMContentLoaded", function (event) {
        var buttons = document.getElementsByClassName('btn-delete');
        for (var i = 0; i < buttons.length; i++) {
            buttons[i].onclick = function (event) {
                event.preventDefault();
                openDeleteConfirmationDialog(event.target.href);
            }
        }
    });


    function openDeleteConfirmationDialog(href) {
        document.getElementById("btn-confirm-delete").onclick = function () {
            window.location = href
        };

        var myModal = new bootstrap.Modal(document.getElementById('exampleCentralModal1'), {
            keyboard: true
        });
        myModal.show();
    }

</script>
</html>
