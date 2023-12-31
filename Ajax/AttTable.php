<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers", "Origin, X-Request-Width, Content-Type, Accept");

require_once (realpath (__DIR__ .'./../src/sql/SQLIN.php'));

if (isset($_GET['Table'])){

    $sql = "SELECT * FROM claims WHERE `Status` = 'Aberto'";
    
    $result = mysqli_query($conn, $sql) or die("Falha na execução da query: " . $mysqli->error);
    
    $QuantPass = $result->num_rows;
    
    while($row = mysqli_fetch_array($result)){
        $LNC[] = $row['LNC'];
        $Ano[] = $row['Ano'];
        $Forn[] = $row['Forn'];
        $Data[] = $row['Data de Abertura'];
    }
    
    for ($i = 0; $i < count($LNC); $i++) {

        $LNCRaw[$i] = $LNC[$i];
    
        if ($LNC[$i] < 10) {
            $LNC[$i] = str_pad($LNC[$i], 3, '0', STR_PAD_LEFT);
        } else if ($LNC[$i] < 100){
            $LNC[$i] = str_pad($LNC[$i], 3, '0', STR_PAD_LEFT);
        }
    
        $Ano[$i] = substr($Ano[$i], -2);
    
        $LNC[$i] = $LNC[$i].'/'.$Ano[$i];
    
        $Data[$i] = date("d/m/Y", strtotime($Data[$i]));
        
    }
    
    for ($i = 0; $i < count($LNC); $i++) {
        echo "<div lnc='$LNC[$i]' onclick='PopClaim($LNCRaw[$i])' class='Row Result S$i'>";
        echo "<div class='RowCell CellText CellLNC'>$LNC[$i]</div>";
        echo "<div class='RowCell CellText CellForn'>$Forn[$i]</div>";
        echo "<div class='RowCell CellText CellData'>$Data[$i]</div>";
        echo "</div>";
    }

}

if (isset($_GET['AttTableBy'])){
    $sql = "SELECT * FROM claimsby ORDER BY `Seq` DESC LIMIT 1";
    
    $result = mysqli_query($conn, $sql) or die("Falha na execução da query: " . $mysqli->error);

    $QuantPass = $result->num_rows;
    
    while($row = mysqli_fetch_array($result)){
        $Resp[] = $row['Resp'];
        $Data[] = $row['Data'];
    }


    
    $Dia = date("d/m/o", strtotime($Data[0]));
    $Hora = date("H:i", strtotime($Data[0]));
    $Person = $Resp[0];


    echo "Atualizado em $Dia às $Hora por $Person";
}


?>
