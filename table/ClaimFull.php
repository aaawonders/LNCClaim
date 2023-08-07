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
    <div class="Header">
        <div class="Link Back">
            <a href="./table.html"><img class="Icon Back-Go" src="./../assets/arrow-left-solid.svg" alt="" srcset=""></a>
        </div>
        <div class="Link Home">
            <a href="./../index.php"><img class="Icon Back-Go" src="./../assets/house-solid.svg" alt="" srcset=""></a>
        </div>

        <div class="head-Title">
            <span>Reclamação - 014/23</span>
        </div>
        <div class="notifications">
            <div class="not-icon">
                <img class="Icon Bell" src="./../assets/bell-regular.svg" alt="" srcset="">
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
            <div class="ClaimTitle">LNC: <span id="LNCSpace">001/<strong>23</strong></span></div>
            <div class="info-box Initial">
                <span class="Info-Title">Informações da Reclamação</span>
                <div class="Title-lnc item-area">Titulo: 
                    <span class="title-value value">Isso é um falha</span>
                </div>
                <div class="Forn-lnc item-area">Fornecedor: 
                    <span class="Forn-value value">Ensinger</span>
                </div>
                <div class="Item-lnc item-area">Componente: 
                    <span class="Item-value value">C 001 017</span>
                </div>
                <div class="Data-lnc item-area">Data da Reclamação: 
                    <span class="Data-value value">05/08/2023</span>
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
                    <span class="Desc-value value">Isso é um falha</span>
                </div>
                <div class="TypeFail-lnc item-area">Tipo de Falha: 
                    <span class="TypeFail-value value">Visual</span>
                </div>
                <div class="EspEnc-lnc item-area"><br>
                    <span class="Esp-value value">Especificado: <span class="Esp"></span></span>
                    <br>
                    <span class="Enc-value value">Encontrado: <span class="Enc"></span></span>
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
                <img src="https://images.unsplash.com/photo-1454496522488-7a8e488e8606?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8bW9udGFpbnxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60" alt="" class="img i1 active">
                <img src="https://images.unsplash.com/photo-1519681393784-d120267933ba?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=870&q=80" alt="" class="img i2">
                <img src="https://images.unsplash.com/photo-1554629947-334ff61d85dc?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8bW9udGFpbnxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60" alt="" class="img i3">
            </div>
            <div class="back-foto arrow"><</div>
            <div class="foward-foto arrow">></div>
            <div class="pags">
                <div class="pag p1 active" onclick="PagGo(1)"></div>
                <div class="pag p2" onclick="PagGo(2)"></div>
                <div class="pag p3" onclick="PagGo(3)"></div>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="./script.js"></script>
</html>