<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET'){

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers", "Origin, X-Request-Width, Content-Type, Accept");

    require_once (realpath (__DIR__ .'/../src/sql/SQLIN.php'));

    if (!isset($_POST['NomeIn']) || !isset($_POST['SobrenomeIn']) || !isset($_POST['UserIn']) || !isset($_POST['EmailIn'])){
        http_response_code(401);
        echo 'Favor inserir Login';
    }
    

    if (isset($_POST['UserIn']) && isset($_POST['UserIn']) || isset($_POST['UserIn']) || isset($_POST['EmailIn'])){
        
    }
}