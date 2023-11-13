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
include_once 'controllers/StatusVendaEnum.php';


$produtoRepository = new ProdutoRepository();

$produtoRepository->showMessage();
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
            foreach ($pedidos['pedidos'] as $pedido) {
                ?>
                <tr style="font-size: 1rem;">
                    <td><strong> <?php echo $pedido["cod_venda"]; ?></strong></td>
                    <td><?php echo $pedido["cliente"]; ?></td>
                    <td><?php echo $pedido["data_venda"]; ?></td>
                    <td><?php if ($pedido["status_venda"] == 1) {
                            echo 'Pendente';
                        } elseif ($pedido["status_venda"] == 2) {
                            echo "Finalizado";
                        }; ?></td>
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
                        <button id="teste" onclick="showCustomer(this.value)" value="<?php echo $pedido["venda_id"]; ?>"
                                type="button" class="btn btn-outline-dark btn-dark"> +
                        </button>
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
<form action="<?php echo ConfigSite::$ROOT; ?>/pedido" method="post">
    <div class="center" style="text-align: center;">

            <strong>Página <?php echo $page_no . " de " . $total_no_of_pages; ?></strong><?php
            include_once 'paginacao-estrutura.php';
         ?>
    </div>
</form>

<br>


<div class="modal" id="exampleCentralModal1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content text-center">
            <div class="modal-header bg-dark text-white d-flex justify-content-center">
                <h5 class="modal-title" id="exampleModalLabel" style="font-size: 1.8rem;">Itens Solicitados</h5>
            </div>
            <div class="modal-body">
                <div class="table-reponsive">
                    <table class="table table-light table-striped" style="text-align: center">
                        <thead class="table" style="background-color: rgba(51,45,45);">
                        <tr style="color: white;font-size: 1rem;">
                            <td>Produto</td>
                            <td>Quantidade ☼</td>
                            <td>Valor</td>
                        </tr>
                        </thead>
                        <tbody id="aqui">

                        </tfoot>
                        </tbody>


                    </table>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-end">
                <input type="hidden" id="btn-confirm-delete" class="btn btn-outline-danger" data-bs-dismiss="modal">
                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>


</body>


<?php include_once "JavaScript/script.html";?>
<script>
    document.addEventListener("DOMContentLoaded", function (event) {
        var buttons = document.getElementsByClassName('btn-dark');
        for (var i = 0; i < buttons.length; i++) {
            buttons[i].onclick = function (event) {
                event.preventDefault();
                showCustomer(event.target.value);
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

    function showCustomer(str) {
        if (str == "") {
            document.getElementById("aqui").innerHTML = "";
            return;
        }
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function () {
            document.getElementById("aqui").innerHTML = this.responseText;
        }
        xhttp.open("GET", "http://localhost/cadastro-produtos/pedido/produtos?q=" + str);
        xhttp.send();
    }

</script>

</html>