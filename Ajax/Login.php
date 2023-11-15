<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers", "Origin, X-Request-Width, Content-Type, Accept");

    require_once (realpath (__DIR__ .'/../src/sql/SQLIN.php'));

    if (!isset($_POST['UserIn']) || !isset($_POST['SenhaIn'])){
        http_response_code(401);
        echo 'Favor inserir Login';
    }
    

    if (isset($_POST['UserIn']) && isset($_POST['SenhaIn'])){
        
        $User = $_POST['UserIn'];
        $SenhaIn = $_POST['SenhaIn'];

        $sql = "SELECT * FROM contas WHERE User = '$User'";

        $result = mysqli_query($conn, $sql) or die("Falha na execução da query: " . $mysqli->error);
    
        $QuantPass = $result->num_rows;

        if ($QuantPass == 0){
            http_response_code(401);
            echo 'Login incorreto';
            exit();
        }

        if ($QuantPass > 0){

            while($row = mysqli_fetch_array($result)){
                $ID = $row['ID'];
                $Nome = $row['Nome'];
                $Sobrenome = $row['Sobrenome'];
                $Email = $row['Email'];
                $SenhaCrypt = $row['Senha'];
                $FirstLogin = $row['FirstLogin'];
                $Status = $row['Status'];
            }

            if ($Status == 'Aguardando Liberacao') {
                http_response_code(302);
                echo 'Aguardando Liberacao';
                exit();
            }

            if ($FirstLogin == 1) {
                http_response_code(302);
                echo 'Trocar Senha';
                exit();
            }

            if (password_verify($SenhaIn, $SenhaCrypt) == false){
                http_response_code(401);
                echo 'Senha Incorreta';
                exit();
            }

            if (password_verify($SenhaIn, $SenhaCrypt) == true){
                http_response_code(202);
                echo 'Entrou';

                 session_start();

                $_SESSION['Login'] = true;
                $_SESSION['Nome'] = $Nome;
                $_SESSION['Sobrenome'] = $Sobrenome;


                setcookie('Nome', $_SESSION['Nome']); // 86400 = 1 day

            }
        }
    }
}