<?php
include_once "controllers/ConfigSite.php";

$authenticator = new Authenticator();
$authenticator->userLogout();
header('<?php echo ConfigSite::$ROOT;?>/login');
?>