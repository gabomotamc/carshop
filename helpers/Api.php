<?php
namespace helpers;

class Api {

    static function response($data,$httpCode) {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header("Access-Control-Allow-Headers: *");
        header('Content-Type: application/json; charset=utf-8');
        http_response_code($httpCode);
        echo json_encode($data,JSON_PRETTY_PRINT);
    }

}
?>