<?php



header("Access-Control-Allow-Origin: *");

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     if (file_exists($_FILES['FileImg']['tmp_name']) || is_uploaded_file($_FILES['FileImg']['tmp_name'])){
        require_once (realpath (__DIR__ .'/../src/sql/SQLIN.php'));

        // Adicionar Pasta

        function Dataa() {

            date_default_timezone_set('America/Sao_Paulo');

            return date('Y-m-d H_i_s');
        }

        $QuantFiles = count($_FILES['FileImg']['name']);

        $path = realpath('./../data/');
        $folder = Dataa();
        $pathtoSave = $path.'/'.$folder;

        echo $pathtoSave;

        mkdir($pathtoSave, 0777, true);

        for ($i = 0; $i < $QuantFiles; $i++){

            $fileExt[$i] = pathinfo($_FILES['FileImg']['name'][$i])['extension'];
            $name[$i] = uniqid().'.'.$fileExt[$i];
            $finalpath[$i] = $pathtoSave.'/'.$name[$i];

            move_uploaded_file($_FILES['FileImg']['tmp_name'][$i], $finalpath[$i]);
        }

        //Adicionar Server

        $LNCSeq = $_POST['LNC'];
        $DataAdicao = Dataa();
        $extensao = $fileExt;
        $local = $folder;

        for ($i = 0; $i < $QuantFiles; $i++){
            
            $sql = "SELECT * FROM arquivos WHERE Nome = '$name[$i]'";

            $result = mysqli_query($conn, $sql) or die("Falha na execução da query: " . $mysqli->error);

            $QuantPass = $result->num_rows;

            if ($QuantPass == 0){
                    $sql = " INSERT INTO `arquivos` (`LNC`, `Data Adicao`, `Nome`, `Local`, `Formato`) 
                    VALUES ('$LNCSeq', '$DataAdicao', '$name[$i]', '$local','$extensao[$i]')";
                
                    mysqli_query($conn, $sql) or die("Falha na execução da query: " . $mysqli->error); 
            
                http_response_code(201);
                echo 'Arquivo Salvo';

            } else {
                global $ErroLog;
                $ErroLog = "Falha ao salvar arquivo";
                echo $ErroLog;
                http_response_code(400);
            }
        }
?>


<!-- <form id="FormtoClaim" action="" method="post" enctype="multipart/form-data">
    <input type="text" name="LNC" id="" value="12">
    <input multiple class="InputForm FileImg" accept="image/png, image/gif, image/jpeg" type="file" name="FileImg[]" id="FileImg">
    <input class="btn btn-success" id=" " type="submit" value="Criar">
</form> -->