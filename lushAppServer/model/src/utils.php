<?php
class Utils {

    public static function isAJAX() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH'])
            && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }

    public static function isPOST() {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    public static function isGET() {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }

    public static function goToPage($newURL) {
        header('Location: '. $newURL);
    }

    public static function setResponseTypeToJSON() {
        header('Content-type: application/json');
    }

    public static function setResponseTypeToHTML() {
        header('Content-type: text/html');
    }

}
?>