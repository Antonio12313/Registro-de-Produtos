<?php
include_once "utils/Navigation.php";
$authenticator = new Authenticator();
$authenticator->userLogout();
Navigation::navigateTo("login");
?>