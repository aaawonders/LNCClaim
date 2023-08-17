<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $LNC = "";

    if (isset($_GET['LNC'])){
        $LNC = $_GET['LNC'];

        include_once (realpath (__DIR__ .'./../Ajax/getClaimFull.php'));

        $Estado = $json['Estado'];
        
        if ($Estado == 1) {
            $LNCFull = $json['LNC'];
            $LNC = explode('/', $LNCFull)[0];
            $Ano = explode('/', $LNCFull)[1];
    
            $Desc = $json['Descricao'];
            $TypeFalha = $json['DescMore']['Type'];
            $Data = $json['Data'];
            $Item = $json['Item'];
            $Status = $json['Status'];
            $Resp = $json['Nidec_Cont']['Contato'];
            $Forn = $json['Forn_Cont']['Nome'];
    
            $File = $json['Files']['FileQuant'];

            if ($TypeFalha == 'Visual'){
                $DimActive = '';
                $DescMore = "";
            } else if ($TypeFalha == 'Dimensional'){
                $DimActive = 'active';
                $DimEsp = $json['DescMore']['DescDim']['Especificado'];
                $DimEnc = $json['DescMore']['DescDim']['Encontrado'];

                $DescMore = "<br>
                <span class='Esp-value value'>Especificado: <span class='Esp'> $DimEsp</span></span>
                <br>
                <span class='Enc-value value'>Encontrado: <span class='Enc'> $DimEnc</span></span>";
            }
    
            if ($File > 0) {
                $Files[] = $json['Files']['File'];
    
                $FileImg = "";
                $active = "active";
                $Pags = "";
    
                for ($i = 0; $i < count($Files) - 1; $i++){
                    $img = $i + 1;
    
                    $FileImg .= "<img src='https://intranet.nidec.local/testes/lnc/data$Files[$i]' alt='' class='img i$img $active'>";
                    $Pags .= "<div class='pag p$img $active' onclick='PagGo($img)'></div>";
                    $active = "";
                }
    
            } else if ($File == 0){
                $FileImg = "Não tem nada";
                $Pags = "";
            }
        }

        if ($Estado == 0) {
            $LNCFull = "";
            $LNC = "";
            $Ano = "";
            $Desc = "";
            $Data = "";
            $Item = "";
            $Status = "";
            $Resp = "";
            $Forn = "";
            $File = "";
            $FileImg = "";
            $Pags = "";

            echo "<div class='Popup'>
            <div class='backdrop'></div>
            <div class='Error'>
                <div class='title-issue'>Houve um problema ao Localizar a reclamação</div>
                <div class='details'>
                    <div class='error-icon'>
                        <img class='Icon Cross' src='https://intranet.nidec.local/testes/lnc/assets/xmark-solid.svg' alt=''srcset=''>
                    </div>
                    <div class='detail-issue'>Não foi possível localizar a reclamação.</div>
                </div>
            </div>
        </div>";
        }


    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reclamações</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style><?php require realpath(__DIR__ . './style.css')?></style>
    <!-- <link rel="stylesheet" href="./table/style.css"> -->
</head>
<body>
    <div class="Header">
        <div class="Link Back">
            <a href="./table.html"><img class="Icon Back-Go" src="https://intranet.nidec.local/testes/lnc/assets/arrow-left-solid.svg" alt="" srcset=""></a>
        </div>
        <div class="Link Home">
            <a href="./../index.php"><img class="Icon Back-Go" src="https://intranet.nidec.local/testes/lnc/assets/house-solid.svg" alt="" srcset=""></a>
        </div>

        <div class="head-Title">
            <span>Reclamação - <?php echo $LNCFull; ?></span>
        </div>
        <div class="notifications">
            <div class="not-icon">
                <img class="Icon Bell" src="https://intranet.nidec.local/testes/lnc/assets/bell-regular.svg" alt="" srcset="">
            </div>
            <div class="not-list nc2">
                <div class="list-title"><span>Notificações</span></div>
                <div class="not n1">
                    <div class="not-title"><span>Prazo para 8D terminou</span></div>
                    <div class="not-details">
                        <div class="icon-detail"></div>
                        <div class="detail-text">o prazo para 001/23 terminou</div>
                    </div>
                    <div class="tools">
                        <span class="more-not">...</span>
                        <span class="close-not">X</span>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>

    <div class="Actions">        
        <div class="Type-edition">
            <span class="Type-edit">Editar</span>
            <span class="Type-look active">Ver</span>
        </div>
    </div>
    <div class="InfoSpace">
        <div class="info-area">
            <div class="ClaimTitle">LNC: <span id="LNCSpace"><?php echo $LNC; ?>/<strong><?php echo $Ano; ?></strong></span></div>
            <div class="info-box Initial">
                <span class="Info-Title">Informações da Reclamação</span>
                <div class="Title-lnc item-area">Titulo: 
                    <span class="title-value value"><?php echo $Desc; ?></span>
                </div>
                <div class="Forn-lnc item-area">Fornecedor: 
                    <span class="Forn-value value"><?php echo $Forn; ?></span>
                </div>
                <div class="Item-lnc item-area">Componente: 
                    <span class="Item-value value"><?php echo $Item; ?></span>
                </div>
                <div class="Data-lnc item-area">Data da Reclamação: 
                    <span class="Data-value value"><?php echo $Data; ?></span>
                </div>
                <div class="Status-lnc item-area">Status Atual:
                    <div class="Status-area">
                        <div class="Status-list">
                            <span id="Eficacia" class="Status-value">Eficácia</span>
                            <span id="Fechado" class="Status-value">Fechado</span>
                            <span id="Aberto" class="Status-value active">Aberto</span>
                        </div> 
                    </div>
                </div>
            </div>
            <div class="info-box Description">
                <span class="Info-Title">Detalhes</span>
                <div class="Desc-lnc item-area">Descrição da Reclamação: 
                    <span class="Desc-value value"><?php echo $Desc; ?></span>
                </div>
                <div class="TypeFail-lnc item-area">Tipo de Falha: 
                    <span class="TypeFail-value value"><?php echo $TypeFalha; ?></span>
                </div>
                <div class="EspEnc-lnc <?php echo $DimActive; ?> item-area">
                    <?php echo $DescMore; ?>
                </div>
            </div>
            <div class="info-box Quantity">
                <span class="Info-Title">Quantidades</span>
                <div class="Table-Quant">
                    <div class="head row Quant">
                        <div class="cell h r1">Nota Fiscal</div>
                        <div class="cell h r2">Quantidade</div>
                        <div class="cell h r3">Local</div>
                    </div>
                    <div class="body row Quant">
                        <div class="cell v r1">153.521</div>
                        <div class="cell v r2">2.401</div>
                        <div class="cell v r3">Estoque</div>
                    </div>
                </div>
            </div>
            <div class="info-box Report">
                <span class="Info-Title item-area">Estado do 8D</span>
            </div>
        </div>
        <div class="imgs info-box">
            <!-- <span class="Info-Title">Imagens</span> -->
            <div class="photos">
                <?php echo $FileImg;?>
            </div>
            <div class="back-foto arrow"><</div>
            <div class="foward-foto arrow">></div>
            <div class="pags">
            <?php echo $Pags;?>
            </div>
        </div>
    </div>
    <!-- <div class="Popup">
        <div class="backdrop"></div>
        <div class="Error">
            <div class="title-issue">Houve um problema ao Localizar a reclamação</div>
            <div class="details">
                <div class="error-icon">
                    <img class="Icon Cross" src="https://intranet.nidec.local/testes/lnc/assets/xmark-solid.svg" alt="" srcset="">
                </div>
                <div class="detail-issue">Não foi possível localizar a reclamação.</div>
            </div>
        </div>
    </div> -->
</body>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://intranet.nidec.local/testes/lnc/table/script.js"></script>
</html>