<?php
session_start();
include_once 'controllers/Authenticator.php';

$url = $_GET["url"];
$urlExplode = explode("/", $url);
$nameController = ucfirst($urlExplode[0] ?: "login") . "Controller";
$caminhoController = 'controllers/' . $nameController . '.php';
$authenticator = new Authenticator();

if (file_exists($caminhoController)) {
    require_once $caminhoController;
    $controller = new $nameController();

    if ($controller instanceof Controller) {
        if ($controller->needAuthentication && !$authenticator->userIsLogged()) {
            header("Location: login");
            exit();
        }
    }


    if (isset($urlExplode[1]) && !empty($urlExplode[1])) {
        $method = ucfirst($urlExplode[1]);
    } else {
        $method = "Index";
    }

    if (method_exists($controller, $method)) {
        $param = array_merge($_GET, $_POST);
        if ($method == 'Edit' || $method == "Update" || $method == "Delete") {
            $controller->$method(end($urlExplode), $param);

        } else {
            $controller->$method($param);
        }


    } else {
        echo "not found";
    }
} else {
    echo "not found";
}