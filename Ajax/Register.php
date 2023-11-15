<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers", "Origin, X-Request-Width, Content-Type, Accept");

    require_once (realpath (__DIR__ .'/../src/sql/SQLIN.php'));

    if (!isset($_POST['NomeIn']) || !isset($_POST['SobrenomeIn']) || !isset($_POST['UserIn']) || !isset($_POST['EmailIn'])){
        http_response_code(401);
        echo 'Favor inserir Login';
    }
    
    if (isset($_POST['User']) && isset($_POST['NewPassword']) && isset($_POST['FirstLogin'])){

        $User = $_POST['User'];
        $NovaSenha = $_POST['NewPassword'];

        $SenhaCrypt = password_hash($NovaSenha, PASSWORD_DEFAULT);

        // $sql = "UPDATE `contas` SET `Senha` = '$SenhaCrypt' AND `FirstLogin` = 0 AND `Status` = 'OK' WHERE `ID` = '$User'";

        $sql = "UPDATE `contas` SET `Senha` = '$SenhaCrypt', `FirstLogin` = 0, `Status` = 'OK' WHERE `User` = '$User'";

        $result = mysqli_query($conn, $sql) or die("Falha na execução da query: " . $mysqli->error);

        http_response_code(201);
        echo 'Senha Criada';
        exit();

    }

    if (isset($_POST['NomeIn']) && isset($_POST['SobrenomeIn']) || isset($_POST['UserIn']) || isset($_POST['EmailIn'])){

        $User = $_POST['UserIn'];
        $Nome = $_POST['NomeIn'];
        $Sobrenome = $_POST['SobrenomeIn'];
        $Email = $_POST['EmailIn'];
        
        date_default_timezone_set('America/Sao_Paulo');
        $DataCriacao = date('Y-m-d H:i:s',time());
        $DataAbertura = date('Y-m-d',time());

        $sql = "SELECT * FROM contas WHERE User = '$User'";

        $result = mysqli_query($conn, $sql) or die("Falha na execução da query: " . $mysqli->error);
    
        $QuantPass = $result->num_rows;

        if ($QuantPass > 0){
            http_response_code(401);
            echo 'Conta já existe';
            exit();
        }

        $sql = "SELECT * FROM contas WHERE Email = '$Email'";

        $result = mysqli_query($conn, $sql) or die("Falha na execução da query: " . $mysqli->error);
    
        $QuantPass = $result->num_rows;

        if ($QuantPass > 0){
            http_response_code(401);
            echo 'Email já cadastrado';
            exit();
        }
    
        if ($QuantPass == 0){

            $id = uniqid();

            $sql = "INSERT INTO `contas`(`ID`, `Nome`, `Sobrenome`, `User`, `Email`, `Senha`, `FirstLogin`, `Status`, `Data_Criacao`) VALUES ('$id', '$Nome', '$Sobrenome', '$User', '$Email', '', 1, 'Aguardando Liberacao', '$DataCriacao')";

            $result = mysqli_query($conn, $sql) or die("Falha na execução da query: " . $mysqli->error);

            http_response_code(201);

            require_once (realpath (__DIR__ .'/mail.php'));
            
            $User = $Nome;
            $Para = $Email;
            $Assunto = "Serviços Qualidade: Conta criada com sucesso";
            $Body = "<style>
                    .Mail{
                        font-family: Helvetica, Sans-Serif;
                        background-color: #f2f2f2;
                        width:40%;
                    }
                    .Body a{
                        text-decoration: none;
                        color: #41b579;
                        font-weight: bold;
                    }
                    .Signature{
                        background-color: #1fb55d;
                        color: white;
                        padding: 15px;
                    }
                </style>
                <div class='Mail'>
                    <h1 class='Titulo'>$Saudacao $User !</h1>

                    <div class='Body'>
                    <p>Sua conta foi criada com sucesso!</p>
                    <br>
                    <p>Um de nossos administradores irá analisar sua conta e irar liberar o acesso assim que possível</p>
                    <br>
                    <p>A sua senha será: <b>123Mudar</b></p>
                    <br>
                    <p>Muito Obrigado!</p>
                    </div>

                    <div class='Signature'>
                        <img src='' alt=''>
                        <div class='Info'>
                            <h2>Serviços de Registro</h2>
                            <p>Email Automático</p>
                        </div>
                    </div>
                </div>";

            SendEmail($Para, $Assunto, $Body, $mail);
            echo 'Conta criada com sucesso';
        }
    }
}