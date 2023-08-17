<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers", "Origin, X-Request-Width, Content-Type, Accept");
header('Content-Type: application/json; charset=utf-8');

require_once (realpath (__DIR__ .'./../src/sql/SQLIN.php'));

if ($_SERVER['REQUEST_METHOD'] == 'GET'){

    if (isset($_GET['GETLNC'])){

        $sql = "SELECT MAX(`LNC`) from claims";
    
        $result = mysqli_query($conn, $sql) or die("Falha na execução da query: " . $mysqli->error);
        
        $QuantPass = $result->num_rows;

        if ($QuantPass == 0) {
            http_response_code(404);

            $json = array('info' => "404: Reclamação não existe");

            $result = json_encode($json);
        
            echo $result;
            exit();
        }

        if ($QuantPass > 0){

            while($row = mysqli_fetch_array($result)){
                $LNC = $row['MAX(`LNC`)'];
            }

            $json = array('info' => "200", 'LNC' => $LNC);

            $result = json_encode($json);
        
            http_response_code(200);
            echo $result;
        }
    }



    if (isset($_GET['LNC'])){

        $LNC = $_GET['LNC'];

        date_default_timezone_set('America/Sao_Paulo');
        $DataCriacao = date('Y-m-d H:i:s',time());
        $mesAtual = date("m", strtotime($DataCriacao));
        $AnoAtual = date("o", strtotime($DataCriacao));

        // Get LNC

        $sql = "SELECT * FROM claims WHERE `LNC` = '$LNC'";
    
        $result = mysqli_query($conn, $sql) or die("Falha na execução da query: " . $mysqli->error);
        
        $QuantPass = $result->num_rows;

        if ($QuantPass == 0) {
            http_response_code(404);

            $json = array('info' => "404: Reclamação não existe");

            $result = json_encode($json);
        
            echo $result;
            exit();
        }

        while($row = mysqli_fetch_array($result)){
            $LNC = $row['LNC'];
            $Ano = $row['Ano'];
            $Data = $row['Data de Abertura'];
            $Forn = $row['Forn'];
            $itemRaw = $row['Item'];
            $Status = $row['Status'];
            $Descricao = $row['Descricao'];
            $Resp = $row['Resp'];
        }

        $Resp = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$Resp);

        $Resp = explode(" ",$Resp)[0];

        if ($LNC < 10) {
            $LNC = str_pad($LNC, 3, '0', STR_PAD_LEFT);
        } else if ($LNC < 100){
            $LNC = str_pad($LNC, 3, '0', STR_PAD_LEFT);
        }
    
        $Ano = substr($Ano, -2);

        $LNC = $LNC.'/'.$Ano;
    
        $DataLNC = date("d/m/Y", strtotime($Data));
        
        $FullDesc = $Descricao;

        $Item = fullItem($itemRaw, $conn);

        $FullItem = $Item[0]." - ".$Item[1]." "."($Item[2])";

        $InfoNidec = InfoIntern($Resp, $conn);

        $ContatoNidec = $InfoNidec[0]." ".$InfoNidec[1];
        $TelefoneNidec = $InfoNidec[2];
        $EmailNidec = $InfoNidec[3];

        $InfoForn = forn($Forn, $conn);

        $Forn = $InfoForn[0];
        $ContatoForn = $InfoForn[2];
        $TelefoneForn = $InfoForn[3];
        $EmailForn = $InfoForn[4];

        $FilesExist = getFiles($LNC, $conn);

        if (!$FilesExist) {
            $FilesQuant = 0;
            $Files = "";
        } else if ($FilesExist) {
            $FilesQuant = $FilesExist[1];

            if ($FilesQuant = 1) {
                $Files = $FilesExist[0];
                $FilesQuant = $FilesExist[1];
            } else if ($FilesQuant > 1) {
                $Files[] = $FilesExist[0];
                $FilesQuant = $FilesExist[1];
            }

        }



        $json = array(
            'queryDate' => $DataCriacao,
            'LNC' => $LNC,
            'Data' => $DataLNC,
            'Item' => $FullItem,
            'Descricao' => $FullDesc,
            'Status' => $Status,
            'Nidec_Cont' => array(
                'Nome' => 'Nidec',
                'Contato' => $ContatoNidec,
                'Telefone' => $TelefoneNidec,
                'Email' => $EmailNidec
            ),            
            'Forn_Cont' => array(
                'Nome' => $Forn,
                'Contato' => $ContatoForn,
                'Telefone' => $TelefoneForn,
                'Email' => $EmailForn
            ),
            'Files' => array(
                'FileQuant' => $FilesQuant,
                'File' => $Files
            )
        );
                
        $result = json_encode($json);
        
        http_response_code(200);
        echo $result;
    }
}

function fullItem($Item, $conn){
    $sql = "SELECT * FROM items WHERE `Codigo Nidec` = '$Item'";
    
    $result = mysqli_query($conn, $sql) or die("Falha na execução da query: " . $mysqli->error);
    
    $QuantPass = $result->num_rows;

    while($row = mysqli_fetch_array($result)){
        $Cod = $row['Codigo Nidec'];
        $NamePT = $row['PT'];
        $Desenho = $row['Codigo Desenho'];
        $Status = intval($row['Situacao']);
    }

    if ($Status == 0) {
        throw new Exception('Item não está mais ativo');
        return false;
    }

    return [$Cod, $NamePT, $Desenho];
}

function forn($Forn, $conn){
    $sql = "SELECT * FROM fornecedores WHERE `Short Name` LIKE '%$Forn%'";
    
    $result = mysqli_query($conn, $sql) or die("Falha na execução da query: " . $mysqli->error);
    
    $QuantPass = $result->num_rows;

    if ($QuantPass == 0){
        throw new Exception('Fornecedor Inexistente');
        return false;
    }

    while($row = mysqli_fetch_array($result)){
        $FornFull = $row['Forn'];
        $FornShort = $row['Short Name'];
        $Contact = $row['Contato'];
        $Tel = $row['Telefone'];
        $Email = $row['Email'];
    }

    return [$FornFull, $FornShort, $Contact, $Tel, $Email];
}


function InfoIntern($Contact, $conn){
    $sql = "SELECT * FROM pessoas WHERE `Nome` LIKE '%$Contact%'";
    
    $result = mysqli_query($conn, $sql) or die("Falha na execução da query: " . $mysqli->error);
    
    $QuantPass = $result->num_rows;

    if ($QuantPass == 0){
        throw new Exception('Pessoa Inexistente');
        return false;
    }

    while($row = mysqli_fetch_array($result)){
        $Nome = $row['Nome'];
        $Sobrenome = $row['Sobrenome'];
        $Tel = $row['Número'];
        $Email = $row['Email'];
    }

    return [$Nome, $Sobrenome, $Tel, $Email];
}


function getFiles($LNC, $conn){
    $sql = "SELECT * FROM arquivos WHERE `LNC` = '$LNC'";
    
    $result = mysqli_query($conn, $sql) or die("Falha na execução da query: " . $mysqli->error);
    
    $QuantPass = $result->num_rows;

    if ($QuantPass == 0){
        return false;
    }

    if ($QuantPass == 1){
        while($row = mysqli_fetch_array($result)){
            $Local = $row['Local'];
            $Arquivo = $row['File'];
            $Formato = $row['Formato'];
        }


       $path = "/data/$Local/$Arquivo";

    }

    if ($QuantPass > 1){
        while($row = mysqli_fetch_array($result)){
            $Local[] = $row['Local'];
            $Arquivo[] = $row['Nome'];
            $Formato[] = $row['Formato'];
        }

        for ($i = 0; $i < $QuantPass; $i++){
            $path[$i] = "/$Local[$i]/$Arquivo[$i]";
        }

    }

    return [$path, $QuantPass];
}
