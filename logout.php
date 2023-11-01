<?php
$authenticator = new Authenticator();
$authenticator->userLogout();
header('Location: http://localhost/cadastro-produtos/login');
?>