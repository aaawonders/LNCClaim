<?php


if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    if (isset($_GET['LNC'])){


        $LNC = $_GET['LNC'];
        require_once (realpath (__DIR__ .'./../../src/sql/SQLIN.php'));

        $url = "https://intranet.nidec.local/testes/lnc/ajax/getClaim.php?LNC=$LNC";

        $curl = curl_init($url);

        // Define a opção para desativar a verificação do certificado SSL
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        // Define a opção para não verificar o nome do host
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

        // Define a opção para retornar o resultado como string
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

        $response = curl_exec($curl);

        if ($response === FALSE) {
            http_response_code(500);
            die("Erro na requisição de API: ". curl_error($curl));
        }

        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        if ($httpCode !== 200){
            http_response_code($httpCode);
            die("Erro de servidor");
        }

        $data = json_decode($response, TRUE);

        if ($data === null){
            http_response_code(400);
            die("Erro na API - Vázia");
        }

        http_response_code(200);

    }
}


?>


<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Model</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="pdf-area">
        <div class="Title">
            <table>
                <tr class="header full-line">
                    <td class="logo" ><img src="./../../assets/Nidec_RGB.jpg" alt="" srcset=""></td>
                    <td class="title-info">Laudo de Não Conformidade</td>
                    <td class="lnc">LNC N°: <span class="lnc-number"><?php echo $data['LNC'] ?></span></td>
                </tr>
            </table>
        </div>
        <div class="line-break"></div>
        <div class="initial-info">
            <div class="Forn-info">
                <span>Informações do Fornecedor:</span>
                <div class="info-forn">
                    <span class="title-campo forn-campo1">Para: 
                        <span class="data-campo forn-campo-data1"><?php echo $data['Forn_Cont']['Contato']; ?></span>
                    </span>
                    <span class="title-campo forn-campo2">Empresa: 
                        <span class="data-campo forn-campo-data2"><?php echo $data['Forn_Cont']['Nome'] ?></span>
                    </span>
                    <span class="title-campo forn-campo3">Telefone: 
                        <span class="data-campo forn-campo-data3"><?php echo $data['Forn_Cont']['Telefone'] ?></span>
                </span>
                    <span class="title-campo forn-campo4">Email: 
                        <span class="data-campo forn-campo-data4"><?php echo $data['Forn_Cont']['Email'] ?></span>
                </span>
                </div>
            </div>
            <div class="Fail-info">
                <span>Informações do Falha:</span>
                <div class="info-fail">
                    <span class="title-campo fail-campo1">Componente: 
                        <span class="data-campo fail-campo-data1"><?php echo $data['Item'] ?></span>
                    </span>
                    <span class="title-campo fail-campo2">Falha Encontrada: 
                        <span class="data-campo fail-campo-data2"><?php echo $data['Descricao'] ?></span>
                    </span>
                    <span class="title-campo fail-campo3">Quantidade Inicial: 
                        <span class="data-campo fail-campo-data3">02</span>
                    </span>
                    <span class="title-campo fail-campo3">Tipo de Falha: 
                        <span class="data-campo fail-campo-data3">Visual / Primeira ocorrência</span>
                    </span>
                </div>
            </div>
        </div>
        <div class="line-break"></div>
        <div class="photos">
            <span>Fotos da Falha: </span>
            <!-- <div class="photos-info">
                <img src="https://intranet.nidec.local/testes/lnc/data/2023-08-05%2010_23_01/64ce4d35442b9.jpeg" alt="" srcset="">
                <img src="https://intranet.nidec.local/testes/lnc/data/2023-08-05%2010_23_01/64ce4d3544007.jpeg" alt="" srcset="">
            </div>
        </div> -->
        <div class="quantidades">
            <span>Quantidades: </span>
            <table class="table-quant">
                <thead>
                    <th>Nota Fiscal</th>
                    <th>Quantidade</th>
                    <th>Local</th>
                </thead>
                <tbody>
                    <tr class="quant quant1">
                        <td class="nf1">135.625</td>
                        <td class="qt1">1.200</td>
                        <td class="lc1">Estoque</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="line-break"></div>
        <div class="Remetente">
            <div class="nidec-info">
                <div class="info-forn">
                    <span class="title-campo nidec-campo1">Aberto por: 
                        <span class="data-campo nidec-campo-data1"><a href="mailto:andre.silva@nidec-gpm.com">André Silva</a></span>
                    </span>
                    <span class="title-campo nidec-campo2">Data da reclamação: 
                        <span class="data-campo nidec-campo-data2">26/10/2023</span>
                    </span>
                </div>
            </div>
        </div>
        <div class="page-break"></div>
        <div class="page-break"></div>
        <div class="photos">
            <span>Fotos da Falha: </span>
            <div class="photos-info">
                <img src="https://intranet.nidec.local/testes/lnc/data/2023-08-05%2010_23_01/64ce4d35442b9.jpeg" alt="" srcset="">
                <img src="https://intranet.nidec.local/testes/lnc/data/2023-08-05%2010_23_01/64ce4d3544007.jpeg" alt="" srcset="">
            </div>
        </div>
    </div>
</body>
</html>