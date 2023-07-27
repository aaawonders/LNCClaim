<?php


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers", "Origin, X-Request-Width, Content-Type, Accept");
header('Content-Type: application/json; charset=utf-8');

$names1 = [];
$values1 = [];
$names2 = [];
$values2 = [];

require_once (realpath (__DIR__ .'./../src/sql/SQLIN.php'));

date_default_timezone_set('America/Sao_Paulo');
$DataCriacao = date('Y-m-d H:i:s',time());
$mesAtual = date("m", strtotime($DataCriacao));
$AnoAtual = date("o", strtotime($DataCriacao));

//Mês
$sql = "SELECT DISTINCT `Forn` FROM `claims` WHERE MONTH(`Data de Abertura`) = $mesAtual"; ;
$result = mysqli_query($conn, $sql) or die("Falha na execução da query: " . $mysqli->error);

$QuantPass = $result->num_rows;

while($row = mysqli_fetch_array($result)){
    $FornExist[] = $row['Forn'];
}

foreach ($FornExist as $key => $forn){
    $sql = "SELECT COUNT(`LNC`) FROM `claims` WHERE MONTH(`Data de Abertura`) = $mesAtual AND `Forn` = '$forn'";

    $Quant[$key] = mysqli_fetch_assoc(mysqli_query($conn, $sql))["COUNT(`LNC`)"];
}

// echo "<pre>";
// var_dump ($Quant);
// echo "</pre>";
// echo "<br>";

// $ContLNC = array_shift($Quant);
// var_dump ($ContLNC);
// echo $ContLNC[1];


$sql = "SELECT * FROM `claims` WHERE MONTH(`Data de Abertura`) = $mesAtual";

// for ($i = 0; $i < count($LNC); $i++) {

//     if ($LNC[$i] < 10) {
//         $LNC[$i] = str_pad($LNC[$i], 3, '0', STR_PAD_LEFT);
//     } else if ($LNC[$i] < 100){
//         $LNC[$i] = str_pad($LNC[$i], 2, '0', STR_PAD_LEFT);
//     }

//     $Ano[$i] = substr($Ano[$i], -2);

//     $LNC[$i] = $LNC[$i].'/'.$Ano[$i];

//     $Data[$i] = date("d/m/Y", strtotime($Data[$i]));
    
// }

// var_dump ($FornExist);

$json = array(
    'monthly' => array(
        'names' => $FornExist,
        'values' => $Quant
    ),'yearly' => array(
        'names' => $names2,
        'values' => $values2
    )
);



// // $json = "monthly: {names: ['teste', 'teste','teste','teste'],values: [1,2,3,4]},yearly: {names: ['teste', 'teste','teste','teste'],values: [1,2,3,4]}";

$result = json_encode($json);

echo $result;