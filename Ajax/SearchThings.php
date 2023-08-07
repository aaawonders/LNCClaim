<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers", "Origin, X-Request-Width, Content-Type, Accept");
header('Content-Type: application/json; charset=utf-8');

if($_SERVER['REQUEST_METHOD'] == 'GET'){

    require_once (realpath (__DIR__ .'./../src/sql/SQLIN.php'));

    if (isset($_GET['Forn'])){

        $Forn = $_GET['Forn'];
        function GetForn($Forn, $conn){

            if (is_null($Forn)){
                http_response_code(400);
                $json = array('info' => "400: Sem valores para pesquisar");
                return $json;
            }


            $sql = "SELECT * FROM fornecedores WHERE `Forn` LIKE '%$Forn%'";
    
            $result = mysqli_query($conn, $sql) or die("Falha na execução da query: " . $mysqli->error);
            
            $QuantPass = $result->num_rows;

            $QuantInfo = "";

            if ($QuantPass === 0){
                http_response_code(404);
                $json = array('info' => "404: Fornecedor Não existe");
                return $json;
            }
            
            if ($QuantPass === 1) {
                while($row = mysqli_fetch_array($result)){
                    $FornFull = $row['Forn'];
                }
                $QuantInfo = "1 valor encontrado";
            }

            if ($QuantPass > 1) {
                while($row = mysqli_fetch_array($result)){
                    $FornFull[] = $row['Forn'];
                }
                $QuantInfo = "$QuantPass valores encontrados";
            }
            

            http_response_code(200);
            $json = array('info' => "200: Pesquisa Finalizada $QuantInfo", 'Fornecedor' => $FornFull);
            return $json;
        }

        echo json_encode(GetForn($Forn, $conn));

    }

    if (isset($_GET['Item']) || isset($_GET['DescItem'])){

        

    }
}