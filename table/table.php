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
        <div class="SheetGen"><img src="./../assets/file-excel-solid.svg">Gerar Planilha</div>
    </div>
    <div class="Years">
        <ul class="Year-Area">
            <li class="Year Previous disabled"><</li>
            <li class="Year Y1" year="2021" onclick="yearChange(this, 2021)">2021</li>
            <li class="Year Y2" year="2022" onclick="yearChange(this, 2022)">2022</li>
            <li class="Year Y3" year="2023" onclick="yearChange(this, 2023)">2023</li>
            <li class="Year Y4 active" year="2024" onclick="yearChange(this, 2024)">2024</li>
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
              <li class="page-item active" onclick="pageChange(this, 1, false)"><a class="page-link" href="#">1</a></li>
              <li class="page-item" onclick="pageChange(this, 2, false)"><a class="page-link" href="#">2</a></li>
              <li class="page-item" onclick="pageChange(this, 3, false)"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">></a></li>
            </ul>
          </nav>
    </div>
    <div class="Popup active">
        <div class="close">X</div>
        <div class="MainInfo">
            <div class="LNCName break">LNC: <p class="LNCNum">022/23</p></div>
            <div class="ClaimTitle">Carcaça com rebarbas</div>
            <dic class="ClaimData break">Data: <p class="dataLnc">01/08/2023</p></dic>

        </div>
        <div class="Details">
            <div class="box1">
                <div class="Forn">Fornecedor: <span> Ensinger</span></div>
                <div class="Forn">Reclamado para: <a href="mailto:carlos@ensinger.com">Carlos</a></div>

                <div class="Forn">Fornecedor: <span></span></div>
                <div class="Forn">Fornecedor: <span></span></div>
            </div>
            <div class="box2"></div>
        </div>
        <div class="actions">
            <a href="" class="btn-sm btn btn-success">Mais informações</a>
            <button class="btn-sm btn btn-success">Histórico</button>
            <button class="btn-sm btn btn-success">Media</button>
            <div class="dropdown">
                <button class="btn-sm btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Exportar
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Excel</a></li>
                    <li><a class="dropdown-item" href="#">PDF</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

</body>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="./script.js"></script>
</html>