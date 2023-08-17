<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET'){

    if (!isset($_POST['UserIn']) || !isset($_POST['UserIn'])){
        http_response_code(401);
        echo 'Favor inserir Login';
    }
    

    if (isset($_POST['UserIn']) && isset($_POST['UserIn'])){
        
    }
}