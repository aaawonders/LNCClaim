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
            <a href=""><img class="Icon Back-Go" src="./../assets/arrow-left-solid.svg" alt="" srcset=""></a>
        </div>
        <div class="head-Title">
            <span>Reclamações</span>
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

    <div class="InfoSpace">
        <div class="Title">Reclamações</div>
        <div class="UpdateSpace">
            <span class="UpBy">Atualizado por: <i>André Silva</i></span>
            <span class="UpIn">Atualizado em: <i>16/07/2023</i></span>
        </div>
    </div>
<div class="TableArea">
    <div class="SearchArea">
        <div class="Search">
            <input placeholder="Pesquisar..." type="text" name="SearchInput" id="SearchInput">
            <div class="SuggestArea"></div>
        </div>
    </div>
    <div class="Years">
        <ul class="Year-Area">
            <li class="Year Previous"><</li>
            <li class="Year Y1">2021</li>
            <li class="Year Y2">2022</li>
            <li class="Year Y3">2023</li>
            <li class="Year Y4 active">2024</li>
        </ul>
    </div>
    <div class="TableClaim">
        <div class="Row HeadRow">
            <div sort="" class="RowCell HeadCell"></div>
            <div sort="" class="RowCell HeadCell">Seq.</div>
            <div sort="" class="RowCell HeadCell">Status</div>
            <div sort="" class="RowCell HeadCell">LNC</div>
            <div sort="" class="RowCell HeadCell">Fornecedor</div>
            <div sort="" class="RowCell HeadCell">Data</div>
            <div sort="" class="RowCell HeadCell">Status 60 dias</div>
            <div sort="" class="RowCell HeadCell">Código</div>
            <div sort="" class="RowCell HeadCell">Motivo da Reclamação</div>
            <div sort="" class="RowCell HeadCell">Status 8D</div>
        </div>
        <div class="Row Result S0">
            <div class="RowCell CellText Cellinfo"><i onclick="OpenClaim('001/23')"><img class="Icon Moon" src="../assets/circle-info-solid.svg" alt="" srcset=""></i></div>
            <div class="RowCell CellText CellSeq">05</div>
            <div class="RowCell CellText CellStatus">Aberto</div>
            <div class="RowCell CellText CellLNC">001/23</div>
            <div class="RowCell CellText CellForn">Ensinger</div>
            <div class="RowCell CellText CellData">01/01/2023</div>
            <div class="RowCell CellText CellStatusSeis">51</div>
            <div class="RowCell CellText CellCod">C001017</div>
            <div class="RowCell CellText CellDesc"><span class="Desc">Rebarbas</span></div>
            <div class="RowCell CellText CelltoDo">Não enviado</div>
        </div>
        <div class="Row Result S1">
            <div class="RowCell CellText Cellinfo"><i onclick="OpenClaim('002/23')"><img class="Icon Moon" src="../assets/circle-info-solid.svg" alt="" srcset=""></i></div>
            <div class="RowCell CellText CellSeq">02</div>
            <div class="RowCell CellText CellStatus">Eficácia</div>
            <div class="RowCell CellText CellLNC">002/23</div>
            <div class="RowCell CellText CellForn">Igus</div>
            <div class="RowCell CellText CellData">14/01/2023</div>
            <div class="RowCell CellText CellStatusSeis">01</div>
            <div class="RowCell CellText CellCod">C011002</div>
            <div class="RowCell CellText CellDesc"><span class="Desc">Manchas</span></div>
            <div class="RowCell CellText CelltoDo">Em análise</div>
        </div>
    </div>
    <div class="Pags">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
              <li class="page-item disabled"><a class="page-link" href="#"><</a></li>
              <li class="page-item active"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">></a></li>
            </ul>
          </nav>
    </div>
</div>

</body>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="./script.js"></script>
</html>