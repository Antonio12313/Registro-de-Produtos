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
    <style>
        .btn.btn-success:hover {
            background-color: white;
            border-color: #000000;
            --mdb-btn-box-shadow-state: 0 8px 9px -4px rgb(0 0 0 / 30%), 0 4px 18px 0 rgba(20, 164, 77, 0.2);
            color: black !important;

        }

        .btn.btn-success {
            background-color: #739072;
            --mdb-btn-box-shadow: 0 4px 9px -4px #000000;
            color: white !important;

        }
    </style>
    <div class="mask d-flex align-items-center h-100 gradient-custom-3"
         style="">
        <div class="container h-100 ">
            <div class="row d-flex justify-content-right align-items-center h-100 ">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6" style="width: 30%;">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-center mb-3">Faça o Login</h2>
                            <form>
                                <div class="form-outline mb-3">
                                    <input type="email" name="login" id="login"
                                           class="form-control form-control-lg"/>
                                    <label class="form-label" for="login">Email</label>
                                </div>
                                <div class="form-outline mb-3">
                                    <input type="password" id="senha" name="senha"
                                           required class="form-control form-control-lg"/>
                                    <label class="form-label" for="senha">Senha</label>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="submit"
                                            class="btn btn-success btn-block btn-lg text-body" name="entrar"
                                            value="Entrar">
                                        Entrar
                                    </button>
                                </div>
                                <?php
                                $produtorepository = new ProdutoRepository();
                                $produtorepository->showMessage();
                                ?>
                                <p class="text-center text-muted mt-3 mb-1">Ainda não possui uma conta? <a
                                            href="cadastroUser"
                                            class="fw-bold text-body"><u>Registre-se</u></a></p>
                            </form>
                        </div>
                    </div>
                </div>
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
