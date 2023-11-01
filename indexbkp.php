<!doctype html>
<html lang="br">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php include_once 'view/Navbar.html'; ?>
<br>
<form class="row g-3" action="http://localhost/cadastro-produtos/prod/" method="post">
    <div class="col-auto">
        <label for="nome" class="visually-hidden">Produto</label>
        <input type="text" class="form-control" placeholder="Nome do produto" aria-label="First name"
               type="text"
               name="nome_filtro" value="<?php echo($produtos['filtros']['nome_filtro'] ?? "") ?>"
               id="nome">
    </div>
    <div class="col-auto">
        <label for="user" class="visually-hidden">Nome</label>
        <input type="text" class="form-control" id="user" name="nome_user" placeholder="Nome do usuário"
               value="<?php echo($produtos['filtros']['nome_user'] ?? "") ?>">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-outline-success mb-3" value="Buscar" name="buscar"
                style="border-color: #739072;">Buscar
        </button>
    </div>
</form>

<?php
$produtorepository = new ProdutoRepository();
$produtorepository->showMessage();
?>

<form action="prod/" method="post">
    <table class="table table-bordered table-striped" style="text-align: center">
        <thead class="table" style="background-color: #739072">

        <tr style="color: white;font-size: 1rem;">
            <td>Nome</td>
            <td>Usuário</td>
            <td>Foi criado em</td>
            <td>Ultima vez Atualizado</td>
            <td>Ação</td>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($produtos['dados'] as $produto) {
            ?>
            <tr style="font-size: 1rem;">
                <td><?php echo $produto["nome"]; ?></td>
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
                    <a href="http://localhost/cadastro-produtos/prod/edit/<?php echo $produto["id"]; ?>"
                       class="btn btn-outline-success" style="border-color: #739072;" tabindex="-1" role="button"
                       aria-disabled="true">Editar</a>

                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                            data-bs-target="#exampleCentralModal1">
                        Deletar
                    </button>
                    <div class="modal fade" id="exampleCentralModal1" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Não</button>
                                    <a href="http://localhost/cadastro-produtos/prod/delete/<?php echo $produto["id"]; ?>"
                                       class="btn btn-outline-danger" tabindex="-1" role="button" aria-disabled="true"
                                       data-bs="modal">Sim</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </td>
            </tr>

            <?php
        }
        ?>
        </tbody>
    </table>
</form>

<form action="prod" method="post">
    <div class="center" style="text-align: center;">
        <?php if (empty($_REQUEST["nome_filtro"])) {
            ?><strong>Página <?php echo $page_no . " de " . $total_no_of_pages; ?></strong><?php
            include_once 'paginacao-estrutura.php';
        } ?>
    </div>
</form>
<br>
<br>
<br>
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
