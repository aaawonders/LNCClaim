<?php

require_once (realpath (__DIR__ .'./src/startPage.php'));

session_start();

if (isset($_SESSION['Login'])){
    $loginClass = 'true';

    $Nome = $_SESSION['Nome'];
    $Sobrenome = $_SESSION['Sobrenome'];

    $loginTools = "<span class='login-actions'>Olá, <b>$Nome</b>...</span><div class='box'><ul>
            <li class='login-option Perfil'>Perfil</li>
            <li class='login-option Config'>Configurações</li>
            <li class='login-option Logoff' onclick='Logoff()'>Sair</li>
        </ul>
    </div>";
    // cookie

} else if ((!isset($_SESSION['Login']))) {
    $loginClass = 'false';
    $loginTools = "<a href=''>Fazer Login</a>";
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="login" content="<?php echo $loginClass;?>">
    <meta name="UserName" content="<?php echo $loginClass;?>">
    <title><?php echo "(".$QuantClaims.") "; ?>Reclamações</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="header">
        <div class="login"><?php echo $loginTools; ?>
        </div>
    </div>
    <div class="ThemeMode Moon">
        <img class="Icon Moon" src="./assets/moon-solid.svg" alt="" srcset="">
        <img class="Icon Sun" src="./assets/sun-regular.svg" alt="" srcset="">
    </div>
    <h2>Reclamações</h2>
    <div id="Actions">
        <div class="buttons">
            <button id="OpenButton" class="btn btn-danger">Abrir Reclamação</button>
            <button id="ClaimGo" class="btn btn-success"><a href="./table/table.html">Lista de Reclamações</a></button>
        </div>

        <div class="search">
            <input type="text" placeholder="Pesquisar..." class="form-control" name="SearchBar" id="Search">
            <div class="sugSearch">
                <span class="sug item1" onclick="SearchClaim()"></span>
                <span class="sug item2" onclick="SearchClaim()"></span>
                <span class="sug item3" onclick="SearchClaim()"></span>
            </div>
        </div>
    </div>
    <div class="Main">
        <div class="boxinfo charts">
            <span class="Title">Gráficos 
                <div class="updateChart Up">
                    <img class="Icon Update Chart" src="./assets/rotate-right-solid.svg" alt="" srcset="">
                </div>
            </span>
            <hr>
            <div class="ChartSpace">
                <canvas id="myChart"></canvas>
                <canvas id="myChart2"></canvas>
            </div>
        </div>
        <div class="boxinfo list">
            <span class="Title">Lista de Reclamações Abertas</span>
            <hr>
            <div class="TableClaim">
                <div class="Row HeadRow">
                    <div class="RowCell HeadCell">LNC</div>
                    <div class="RowCell HeadCell">Fornecedor</div>
                    <div class="RowCell HeadCell">Data</div>
                </div>
            </div>
            <div class="UpdateIn">
                <Span>Atualizado em 13/07/2023 às 13:58 por Cláudio Idalgo</Span>
            </div>
        </div>
    </div>
    <div class="PUp">
        <div class="blur"></div>
        <div class="OpenClaim">
            <h5>Nova Reclamação</h5>
            <!-- <hr class="hrClaim"> -->
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
                        <!-- <div class="EncEsppSpace divSpace">
                                <input type="checkbox" name="ckVisual" id="ckVisual">
                                <label for="ckVisual">Falha Visual</label>
                        </div>
                        <div class="EncEspSpace divSpace">
                            <div class="EncSpace divSpace">
                                <span class="label-EspEnc Enc">Encontrado: </span>
                                <input type="text" name="Enc-input" id="Enc-input" class="InputForm">
                            </div>
                            <div class="EspSpace divSpace">
                                <span class="label-EspEnc Esp">Especificado: </span>
                                <input type="text" name="Esp-input" id="Esp-input" class="InputForm">
                            </div>
                        </div> -->
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
                            <div class="RespSpace divSpace"><?php
                            if (isset($_SESSION['Login'])){
                                echo "<span class='Resp-Logged'>$Nome $Sobrenome</span>";
                            } else {
                                echo "<input placeholder='Responsável' class='InputForm' name='Resp' id='Resp'>";
                            }
                            ?>
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
                                Fornecedor:
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
                        <!-- <img class="imge i1 active" src="https://images.unsplash.com/photo-1468581264429-2548ef9eb732?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=870&q=80" alt="">
                        <img class="imge i2" src="https://images.unsplash.com/photo-1439405326854-014607f694d7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Nnx8c2VhfGVufDB8fDB8fHww&auto=format&fit=crop&w=2800&q=60" alt="" srcset="">
                        <img class="imge i3" src="https://plus.unsplash.com/premium_photo-1669227514211-1fb0614af821?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1032&q=80" alt="" srcset=""> -->
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
            <div class="loading claim">
                <div class="spinner-border text-success" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div class="btnsub">
                <button id="OKBtn" class="btn btn-success">OK</button>
            </div>
        </div>
        <form id="loginForm" class="Loginform" method="post">
            <div class="Title">
                <span>Fazer Login</span>
            </div>
            <div class="Username Infield field">
                <label for="UserIn">Usuário</label>
                <input class="inLogin User" type="text" name="UserIn" id="UserIn" required>
            </div>
            <div class="Senha Infield field">
                <label for="SenhaIn">Senha</label>
                <input class="inLogin Senha" type="password" name="SenhaIn" id="SenhaIn" required>
                <div class="show spass">
                    <img class="show i1" src="https://intranet.nidec.local/testes/lnc/assets/eye-solid.svg" alt="" srcset="">
                    <img class="i2" src="https://intranet.nidec.local/testes/lnc/assets/eye-slash-solid.svg" alt="" srcset="">
                </div>
            </div>
            <div class="LembrarSenha field">
                <input type="checkbox" name="LembrarIn" id="LembrarIn">
                <label for="LembrarIn">Lembrar Senha</label>
            </div>
            <div class="btn-go Passfield field">
                <input type="submit" class=" btn btn-success" value="Entrar">
            </div>
            <div class="Plus field">
                <span class="Goto"><a href="" class="GoRegister">Registrar</a></span>
                <span class="Goto"><a href="" class="ForgetPass">Esqueci a senha</a></span>
            </div>
        </form>
        <form id="RegisterForm" class="Loginform" method="post">
            <div class="Title">
                <span>Registrar</span>
            </div>
            <!-- <div class="alert alert-warning d-flex align-items-center"  role="alert">
                    Conta já existe
            </div> -->
            <div class="Nomes Infield field">
                <div class="Nome Infield field">
                    <label for="NomeIn">Nome</label>
                    <input class="inLogin inRegister Nome" type="text" name="NomeIn" id="NomeIn" required>
                </div>
                <div class="Sobrenome Infield field">
                    <label for="SobrenomeIn">Sobrenome</label>
                    <input class="inLogin inRegister Sobrenome" type="text" name="SobrenomeIn" id="SobrenomeIn" required>
                </div>
            </div>
            <div class="Username Infield field">
                <label for="UserIn">Escolha seu Usuário</label>
                <input class="inLogin inRegister User" type="text" name="UserIn" id="UserIn" required>
            </div>
            <div class="Email Infield field">
                <label for="UserIn">Digite seu Email</label>
                <input class="inLogin inRegister Email" type="email" name="EmailIn" id="EmailIn" required>
            </div>
            <div class="btn-go Passfield field">
                <input type="submit" class=" btn btn-success" value="Registrar">
            </div>
            <div class="Plus field">
                <span class="Goto">Tem conta? <a href="" class="GoLogin">Fazer Login</a></span>
            </div>
        </form>
        <div class="Loginform add">
            <!-- <div class="Password-change Msg">
                <div class="text">
                        <p>Usuário, favor altere a sua senha.</p>
                </div>
                <form class="input-Pass" method="post">
                    <input type="hidden" name="ID" value="">
                    <input class="inLogin SenhaNew" type="password" name="SenhaNew" id="SenhaNew" onkeyup="Validate(this.value)" required>
                </form>
                <button class="Change-Senha btn btn-success">OK</button>
            </div> -->
            <!-- <div class="Complete-Login Msg">
                <div class="Logo">
                    <img class="show i1" src="http://intranet.nidec.local/testes/lnc/assets/circle-check-regular.svg" alt="" srcset="">
                </div>
                <div class="Title">
                    <p>Conta criada com sucesso</p>
                </div>
                <div class="text">
                    <p>É necessário aprovação da conta por parte do administrador.</p>
                    <p>Um email será enviado assim que você for aprovado.</p>
                </div>
                <button class="Close-pop btn btn-success">OK</button>
            </div> -->
            <!-- <div class="Waiting-Login Msg">
                <div class="Logo">
                    <img class="" src="http://intranet.nidec.local/testes/lnc/assets/undraw_mindfulness.svg" alt="" srcset="">
                </div>
                <div class="Title">
                    <p>Sua conta está sendo analisada</p>
                </div>
                <div class="text">
                    <p>É necessário esperar a liberação de sua conta</p>
                </div>
                <button class="Close-pop btn btn-success">OK</button>
            </div> -->
    </div>

    <div class="toast align-items-center text-bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
                <div class="toast-body">
                Hello, world! This is a toast message.
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="./script.js"></script>
</html>