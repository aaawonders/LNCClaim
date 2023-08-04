<?php
if (!isset($_COOKIE['Theme'])){
    setcookie("Theme", "Day", time() + (10 * 365 * 24 * 60 * 60));
}

if (isset($_COOKIE['ThemeSession'])){
    if ($_COOKIE['ThemeSession'] == 'Moon'){
        $_COOKIE['Theme'] = 'Moon';
    } else if ($_COOKIE['ThemeSession'] == 'Sun'){
        $_COOKIE['Theme'] = 'Sun';
    }
}

if (isset($_COOKIE['Theme'])){
    if ($_COOKIE['Theme'] == 'Moon'){
        echo "<script>ThemeChange('Moon', false);</script>";
    } else if ($_COOKIE['Theme'] == 'Sun'){
        echo "<script>ThemeChange('Sun', false);</script>";
    }
}

require_once (realpath (__DIR__ .'./src/startPage.php'));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "(".$QuantClaims.") "; ?>Reclamações</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="./styleClaim.css">
</head>
<body>
    <div class="ThemeMode Moon">
        <img class="Icon Moon" src="./assets/moon-solid.svg" alt="" srcset="">
        <img class="Icon Sun" src="./assets/sun-regular.svg" alt="" srcset="">
    </div>
        <div class="OpenClaim active">
            <h5>Nova Reclamação</h5>
            <form id="FormtoClaim" action="" method="post" enctype="multipart/form-data">
            <div class="FormClaim">
                <div class="boxbreak">                    
                    <div class="Area1 form-OClaim">
                    <span class="Title-Style">Informações do Fornecedor</span>
                        <div class="FornAct">
                            <input placeholder="Fornecedor" class="InputForm" name="Forn" id="Forn">
                            <div class="sugSpace active"></div>
                        </div>
                    </div>
                    <div class="Area2 form-OClaim">
                    <span class="Title-Style">Número da LNC</span>
                        <div class="LNCSpace divSpace">
                            <input placeholder="LNC" class="InputForm" name="LNC" id="LNCNum">
                        </div>
                    </div>
                </div>
                    <div class="Area3 form-OClaim">
                        <span class="Title-Style">Informações do Item</span>
                        <div class="ItemSpace divSpace">
                            <input placeholder="Item" class="InputForm" name="Item" id="CodItem">
                            <input placeholder="Descrição do Item" class="InputForm" name="DescItem" id="Item">
                        </div>
                    </div>
                    <div class="Area4 form-OClaim">
                    <span class="Title-Style">Descrição da Falha</span>
                        <div class="DescSpace divSpace">
                            <textarea placeholder="Descrição" class="InputForm" name="Desc" id="Desc" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="boxbreak">  
                        <div class="Area5 form-OClaim">
                            <span class="Title-Style">Fotos da peça</span>
                            <div class="FileSpace divSpace">
                                <input multiple class="InputForm FileImg" accept="image/png, image/gif, image/jpeg" type="file" name="FileImg[]" id="FileImg">
                                <label for="FileImg" class="FileImgLabel">Adicionar imagens</label>
                                <button id="ClearFiles">X</button>
                            </div>
                        </div>
                        <div class="Area6 form-OClaim">
                        <span class="Title-Style">Responsável pela reclamação</span>
                            <div class="RespSpace divSpace">
                                <input placeholder="Responsável" class="InputForm" name="Resp" id="Resp">
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="btnsub">
                    <button id="CancelBtn" class="btn btn-danger">Cancelar</button>
                    <label for=""></label>
                    <input class="btn btn-success" id=" " type="submit" value="Criar">
                </div>
            </form>
        </div>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="./script.js"></script>
</html>