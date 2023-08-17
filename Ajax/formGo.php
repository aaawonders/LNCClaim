<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers", "Origin, X-Request-Width, Content-Type, Accept");

require_once (realpath (__DIR__ .'/../src/sql/SQLIN.php'));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['LNC']) && isset($_POST['Forn']) && isset($_POST['Item']) && isset($_POST['Desc'])){

        $LNC = $_POST['LNC'];

        $LNCSplit = explode('/', $LNC);
        $LNCSeq = intval($LNCSplit[0]);

        $LNCAno = DateTime::createFromFormat('y', intval($LNCSplit[1]));
        $LNCAno = $LNCAno->format('Y');

        $Forn = $_POST['Forn'];
        $Item = $_POST['Item'];
        $Desc = $_POST['Desc'];
        $Resp = $_POST['Resp'];

        $sql = "SELECT * FROM claims WHERE LNC = '$LNCSeq'";

        $result = mysqli_query($conn, $sql) or die("Falha na execução da query: " . $mysqli->error);
    
        $QuantPass = $result->num_rows;
    
        if ($QuantPass == 0){
    
            date_default_timezone_set('America/Sao_Paulo');
            $DataCriacao = date('Y-m-d H:i:s',time());
            $DataAbertura = date('Y-m-d',time());
    
            $sql = " INSERT INTO `claims` (`LNC`, `Ano`, `Data de Abertura`, `Forn`, `Item`, `Descricao`,`Status`, `Resp`,`Data Criacao`) 
            VALUES ('$LNCSeq', '$LNCAno', '$DataAbertura', '$Forn', '$Item','$Desc', 'Aberto', '$Resp','$DataCriacao')";
    
            mysqli_query($conn, $sql) or die("Falha na execução da query: " . $mysqli->error);  
            
            if (file_exists($_FILES['FileImg']['tmp_name'][0]) || is_uploaded_file($_FILES['FileImg']['tmp_name'][0])) 
            {
                include_once (realpath (__DIR__ .'/formFiles.php'));
            }

            http_response_code(201);
            echo 'foi';

            return true;
        } else {
            global $ErroLog;
            $ErroLog = "Reclamação já existe";
            echo $ErroLog;
            http_response_code(401);
        }

    } else {
        global $ErroLog;
        $ErroLog = "Campos faltando informações";
        echo $ErroLog;
        http_response_code(400);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    echo $_GET['teste'];
}

?>