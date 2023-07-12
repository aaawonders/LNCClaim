<?php

require_once (realpath (__DIR__ .'/src/sql/SQLIN.php'));

$sql = "SELECT * FROM claims";

$result = mysqli_query($conn, $sql) or die("Falha na execução da query: " . $mysqli->error);

$QuantPass = $result->num_rows;

while($row = mysqli_fetch_array($result)){
    $LNC[] = $row['LNC'];
    $Ano[] = $row['Ano'];
    $Forn[] = $row['Forn'];
    $Data[] = $row['Data de Abertura'];
}

for ($i = 0; $i < count($LNC); $i++) {

    if ($LNC[$i] < 10) {
        $LNC[$i] = str_pad($LNC[$i], 3, '0', STR_PAD_LEFT);
    } else if ($LNC[$i] < 100){
        $LNC[$i] = str_pad($LNC[$i], 2, '0', STR_PAD_LEFT);
    }

    $Ano[$i] = substr($Ano[$i], -2);

    $LNC[$i] = $LNC[$i].'/'.$Ano[$i];

    $Data[$i] = date("d/m/Y", strtotime($Data[$i]));
    
}

for ($i = 0; $i < count($LNC); $i++) {
    echo "<div class='Row Result S$i'>";
    echo "<div class='RowCell CellText CellLNC'>$LNC[$i]</div>";
    echo "<div class='RowCell CellText CellForn'>$Forn[$i]</div>";
    echo "<div class='RowCell CellText CellData'>$Data[$i]</div>";
    echo "</div>";
}

?>
