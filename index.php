<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $LNC = $_POST['LNC'];
      $Forn = $_POST['Forn'];

      $Item = $_POST['Item'];
      $DescItem = $_POST['DescItem'];
      $Desc = $_POST['Desc'];
      $QuantFiles = count($_FILES['FileImg']['name']);

      $fileExt = pathinfo($_FILES['FileImg']['name'][0])['extension'];

      $path = realpath('./data/');

      $pathtoSave = $path.'/'.Dataa();

    mkdir($pathtoSave, 0777, true);

    for ($i = 0; $i < $QuantFiles - 1;$i++){
        move_uploaded_file($_FILES['FileImg']['tmp_name'][$i], $pathtoSave.'/'.uniqid().'.'.$fileExt);
    }
}


function Dataa() {

    date_default_timezone_set('America/Sao_Paulo');

    return date('Y-m-d H_i_s');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reclamações</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="ThemeMode Moon">
        <img class="Icon Moon" src="./assets/moon-solid.svg" alt="" srcset="">
        <img class="Icon Sun" src="./assets/sun-regular.svg" alt="" srcset="">
    </div>
    <h2>Reclamações</h2>
    <div id="Actions">
        <div class="buttons">
            <button id="OpenButton" class="btn btn-danger">Abrir Reclamação</button>
            <button class="btn btn-success">Lista de Reclamações</button>
        </div>

        <div class="search">
            <input type="text" placeholder="Pesquisar..." class="form-control" name="SearchBar" id="Search">
        </div>
    </div>
    <div class="Main">
        <div class="boxinfo charts">
            <span class="Title">Gráficos</span>
            <hr>
            <div class="ChartSpace">
                <canvas id="myChart"></canvas>
                <canvas id="myChart2"></canvas>
            </div>
        </div>
        <div class="boxinfo list">
            <span class="Title">Lista de Reclamações</span>
            <hr>
            <div class="TableClaim">
                <div class="Row HeadRow">
                    <div class="RowCell HeadCell">LNC</div>
                    <div class="RowCell HeadCell">Fornecedor</div>
                    <div class="RowCell HeadCell">Data</div>
                </div>
                <div class="Row Result S1">
                    <div class="RowCell CellText CellLNC">001/23</div>
                    <div class="RowCell CellText CellForn">Ensinger</div>
                    <div class="RowCell CellText CellData">01/01/2023</div>
                </div>
            </div>
        </div>
    </div>
    <div class="PUp">
        <div class="blur"></div>
        <div class="OpenClaim">
            <h5>Nova Reclamação</h5>
            <hr>
            <form id="FormtoClaim" action="" method="post" enctype="multipart/form-data">
            <div class="FormClaim">
                    <div class="LNCSpace divSpace">
                        <input placeholder="Fornecedor" class="InputForm" name="Forn" id="Forn">
                        <input placeholder="LNC" class="InputForm" name="LNC" id="LNCNum">
                        <div class="sugSpace active">
                        </div>
                    </div>
                    <div class="ItemSpace divSpace">
                        <input placeholder="Item" class="InputForm" name="Item" id="CodItem">
                        <input placeholder="Descrição do Item" class="InputForm" name="DescItem" id="Item">
                    </div>
                    <div class="DescSpace divSpace">
                        <textarea placeholder="Descrição" class="InputForm" name="Desc" id="Desc" cols="30" rows="10"></textarea>
                    </div>
                    <div class="FileSpace divSpace">
                        <input multiple class="InputForm FileImg" accept="image/png, image/gif, image/jpeg" type="file" name="FileImg[]" id="FileImg">
                        <label for="FileImg" class="FileImgLabel">Adicionar imagens</label>
                        <button id="ClearFiles">X</button>
                    </div>
                </div>
                <hr>
                <div class="btnsub">
                    <button id="CancelBtn" class="btn btn-danger">Cancelar</button>
                    <label for=""></label>
                    <input class="btn btn-success" type="submit" value="Criar">
                    <!-- <button  >Criar</button> -->
                </div>
            </form>
        </div>
        <div class="ClaimInfo">
            <div class="InfoZone">
                <div class="LNCZone">
                    <span class="DataClaim">Data: <span class="DataRes"></span></span>
                    <span class="LNCClaim">LNC: <span class="LNCRes"></span></span>
                </div>
                <div class="ContactZone">
                    <div class="FornZone ContZone Zone">
                        <span>Forn Info:</span>
                        <div class="FornCon">
                            <span>
                                Cliente:
                                <span class="FornName campo"></span>
                            </span>
                            <span>
                                Contato:
                                <span class="FornCont campo"></span>
                            </span>
                            <span>
                                Telefone:
                                <span class="FornTel campo"></span>
                            </span>
                            <span>
                                Email:
                                <span class="FornEmail linkEmail campo"><a class="linkEmailForn" href="mailto:"></a></span>
                            </span>
                        </div>
                    </div>
                    <div class="CustomerZone ContZone Zone">
                        <span>Cliente Info:</span>
                        <div class="CustCon">
                            <span>
                                Cliente:
                                <span class="CustName campo"></span>
                            </span>
                            <span>
                                Contato:
                                <span class="CustCont campo"></span>
                            </span>
                            <span>
                                Telefone:
                                <span class="CustTel campo"></span>
                            </span>
                            <span>
                                Email:
                                <span class="CustEmail linkEmail campo"><a class="linkEmailCust" href="mailto:"></a></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="ItemZone Zone">
                    Item:
                    <br>
                    <div class="ItemSpace">
                        <span class="ItemRes"></span>
                        <span class="ItemDescRes"></span>
                    </div>
                </div>
                <div class="DescZone Zone">
                    Descrição:
                    <br>
                    <span class="DescZone">
                        <span class="DescRes"></span>
                        <span class="EncZone">- Encontrado: <span class="EncRes"></span></span>
                        <span class="EspZone">- Especificado: <span class="EspRes"></span></span>
                    </span>
                </div>
                <div class="ImgZone"></div>
                <div class="Imgs">
                    <div class="imgShow">
                        <img class="imge i1 active" src="https://images.unsplash.com/photo-1468581264429-2548ef9eb732?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=870&q=80" alt="">
                        <img class="imge i2" src="https://images.unsplash.com/photo-1439405326854-014607f694d7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Nnx8c2VhfGVufDB8fDB8fHww&auto=format&fit=crop&w=2800&q=60" alt="" srcset="">
                        <img class="imge i3" src="https://plus.unsplash.com/premium_photo-1669227514211-1fb0614af821?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1032&q=80" alt="" srcset="">
                    </div>
                    <button class="btnclose">X</button>
                    <button class="btnChange GoBack"><</button>
                    <button class="btnChange GoFor">></button>
                    <div class="Pages">
                        <span class="ActualPage"></span>
                         /
                         <span class="TotalPages"></span> 
                    </div>
                </div>
            </div>
            <div class="btnsub">
                <button id="OKBtn" class="btn btn-success">OK</button>
            </div>
        </div>
    </div>


</body>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="./script.js"></script>
</html>