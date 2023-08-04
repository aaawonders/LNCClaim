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

$FornExist = [];
$Quant = [];

while($row = mysqli_fetch_array($result)){
    $FornExist[] = $row['Forn'];
}

if (!$FornExist) {
    $FornExist[0] = 0;
    $Quant[0] = 0;
} else {
    foreach ($FornExist as $key => $forn){
        $sql = "SELECT COUNT(`LNC`) FROM `claims` WHERE MONTH(`Data de Abertura`) = $mesAtual AND `Forn` = '$forn'";
    
        $Quant[$key] = intval(mysqli_fetch_assoc(mysqli_query($conn, $sql))["COUNT(`LNC`)"]);
    }
}


//Anual

// $mesAtual = 1;


if ($mesAtual == 1) {
    $sql = "SELECT COUNT(`LNC`) FROM `claims` WHERE MONTH(`Data de Abertura`) = $mesAtual AND YEAR(`Data de Abertura`) = $AnoAtual";
    
    $names2 = array (mesExtenso($mesAtual));
    $Quant2 = array(mysqli_fetch_assoc(mysqli_query($conn, $sql))["COUNT(`LNC`)"]);

    foreach($Quant2 as $key => $value){
        $Quant2[$key] = intval($value);
    }
}


if ($mesAtual > 1) {
    for ($i = 1; $i < $mesAtual +1; $i++){
        $sql = "SELECT COUNT(`LNC`) FROM `claims` WHERE MONTH(`Data de Abertura`) = $i AND YEAR(`Data de Abertura`) = $AnoAtual";
    
        $names2[$i - 1] = mesExtenso($i);
        $Quant2[$i - 1] = intval(mysqli_fetch_assoc(mysqli_query($conn, $sql))["COUNT(`LNC`)"]);
    }
}



// var_dump ($Quant2);

function mesExtenso($mes){
    if ($mes == 1){
        return "Jan";
    } else if ($mes == 2){
        return "Fev";
    } else if ($mes == 3){
        return "Mar";
    } else if ($mes == 4){
        return "Abr";
    } else if ($mes == 5){
        return "Mai";
    } else if ($mes == 6){
        return "Jun";
    } else if ($mes == 7){
        return "Jul";
    } else if ($mes == 8){
        return "Ago";
    } else if ($mes == 9){
        return "Set";
    } else if ($mes == 10){
        return "Out";
    } else if ($mes == 11){
        return "Nov";
    } else if ($mes == 12){
        return "Dez";
    }
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
    'queryDate' => $DataCriacao,
    'monthly' => array(
        'names' => $FornExist,
        'values' => $Quant
    ),'yearly' => array(
        'names' => $names2,
        'values' => $Quant2
    )
);



// // $json = "monthly: {names: ['teste', 'teste','teste','teste'],values: [1,2,3,4]},yearly: {names: ['teste', 'teste','teste','teste'],values: [1,2,3,4]}";

$result = json_encode($json);

echo $result;