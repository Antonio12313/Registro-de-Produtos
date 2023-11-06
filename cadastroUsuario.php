<!doctype html>
<html lang="br">
<head>

    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<section>
    <style>
        .colorr {
            background: #739072;
            height: 100vh;
            width: 120vh;
        }

        .fonte {
            color: white;
            font-size: 43px;
            margin-top:  -40px;;
        }
    </style>
    <div class="colorr ">
        <div class=" row d-flex justify-content-right align-items-center h-100">
            <div class="text-center">
                <img src="public/imagens/imgg.png" class="img-fluid" alt=""  style="width: 400px; margin-bottom: -107px;">
                <p class="fonte" style="font-family: cursive; ">Cradastre-se aqui para poder ter controle do seu estoque!</p>
            </div>
        </div>
    </div>
</section>
<section>
    <form action="CadastroUser" method="post">
        <style>
            .justify-content-right {
                justify-content: right !important;
            }

            .card-body.p-5 {
                padding: 1.5rem !important;
            }

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
                                <h2 class="text-uppercase text-center mb-3">Crie Sua Conta</h2>
                                <form>
                                    <div class="form-outline mb-3">
                                        <input type="text" name="nome" id="nome" class="form-control form-control-lg"/>
                                        <label class="form-label" for="nome">Seu Nome</label>
                                    </div>
                                    <div class="form-outline mb-3">
                                        <input type="email" name="login_cadastro" id="login_cadastro"
                                               class="form-control form-control-lg"/>
                                        <label class="form-label" for="login_cadastro">Email</label>
                                    </div>
                                    <div class="form-outline mb-3">
                                        <input type="password" id="senha_cadastro" name="senha_cadastro" minlength="8"
                                               required class="form-control form-control-lg"/>
                                        <label class="form-label" for="senha_cadastro">Senha</label>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit"
                                                class="btn btn-success btn-block btn-lg text-body">
                                            Registre-se
                                        </button>
                                    </div>
                                    <p class="text-center text-muted mt-3 mb-1">Você já possui uma conta? <a
                                                href="login"
                                                class="fw-bold text-body"><u>Tela de Login</u></a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>

<?php include_once "JavaScript/script.html";?>

</body>
</html>