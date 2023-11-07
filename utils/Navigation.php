<?php
include_once "controllers/ConfigSite.php";

class Navigation {

    static function navigateTo($url) {
        $baseUrl = ConfigSite::$ROOT;
        header("Location: $baseUrl/$url");
    }

    static function navigateToBack() {
        self::navigateTo($_REQUEST["url"]);
    }
}