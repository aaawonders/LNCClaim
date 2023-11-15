<?php

$Saudacao = 'Boa tarde';
// $User = 'André';
// $URL = 'https://intranet.nidec.local/nidec/src/mailer/Rec-Senha/Recuperacao.php?Token=YWFhYUBnbWFpbC5jb20mMTQmQUFBQSZ0cnVl';



$Body = "<style>
    .Mail{
        font-family: Helvetica, Sans-Serif;
        background-color: #f2f2f2;
        width:40%;
    }
    .Body a{
        text-decoration: none;
        color: #41b579;
        font-weight: bold;
    }
    .Signature{
        background-color: #1fb55d;
        color: white;
        padding: 15px;
    }
</style>
<div class='Mail'>
    <h1 class='Titulo'>$Saudacao $User !</h1>

    <div class='Body'>
    <p>Sua conta foi criada com sucesso!</p>
    <br>
    <p>Um de nossos administradores irá analisar sua conta e irar liberar o acesso assim que possível</p>
    <br>
    <p>A sua senha será: <b>123Mudar</b></p>
    <br>
    <p>Muito Obrigado!</p>
    </div>

    <div class='Signature'>
        <img src='' alt=''>
        <div class='Info'>
            <h2>Serviços de Registro</h2>
            <p>Email Automático</p>
        </div>
    </div>
</div>";



require_once (realpath (__DIR__ .'/../../../Nidec/src/Mailer/Mail2.php'));
