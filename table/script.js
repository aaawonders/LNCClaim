
var webAjax = "192.168.0.190";

$(document).ready(function () {

    
    StatusStyle();
    SeisStatusStyle();
    CompleteReclam();
    var claim = getClaims();

    window.onkeydown = function(event) {
        if ( event.keyCode == 27 ) {
          if ($('.not-list').hasClass('active')){      
            $('.not-list').removeClass('active');
          }
        }
      };
  });


function StatusStyle(){
    $(".CellStatus").each(function (indexInArray, value) { 
        var status = value.innerHTML;

        if (status == 'Aberto'){
            $(this).css('background-color', 'rgb(212, 212, 70)');
            $(this).css('color', 'rgb(51, 51, 5)');
        } else if (status === 'Eficácia') {
            $(this).css('background-color', 'rgb(53, 159, 230)');
            $(this).css('color', 'rgb(5, 33, 51)');
        } else if (status === 'Ação Implem.') {
            $(this).css('background-color', 'rgb(53, 230, 121)');
            $(this).css('color', 'rgb(5, 51, 33)');
        } else if (status === 'Cancelada') {
            $(this).css('background-color', 'rgb(230, 109, 53)');
            $(this).css('color', 'rgb(51, 12, 5)');
        }
    });
}

function SeisStatusStyle(){
    $(".CellStatusSeis").each(function (indexInArray, value) { 
        var status = value.innerHTML;

        if (status <= 30){
            $(this).css('background-color', 'rgb(158, 230, 177)');
            $(this).css('color', 'rgb(19, 28, 22)');
        } else if (status > 30 && status < 45) {
            $(this).css('background-color', 'rgb(207, 196, 136)');
            $(this).css('color', 'rgb(20, 19, 11)');
        } else if (status >= 45 && status < 60) {
            $(this).css('background-color', 'rgb(217, 179, 145)');
            $(this).css('color', 'rgb(43, 31, 20)');
        } else if (status >= 60) {
            $(this).css('background-color', 'rgb(235, 118, 106)');
            $(this).css('color', 'rgb(0, 0, 0)');
        } 
    });
}

function CompleteReclam(){

    $(".Desc").each(function (indexInArray, value) { 
        $(this).attr("Reclam", "Isso é um teste");
        
    });
}

$('.HeadCell').click(function (e) { 
    e.preventDefault();

    var el = e.target;
    var Coluna = el.attributes[0].value;
    var tipo = el.innerText;

    function resetArrows(){
        $(".HeadCell").each(function (indexInArray, value) { 
            let header = value.innerText;
            $(this).html(header);
            $(this).attr('sort', '');
        });
    }

    if (tipo !== 'info'){
        if (Coluna == '') {
            resetArrows()
            $(this).html(tipo + ` <i class="Arrow Ascen"><img src="../assets/arrow-up-solid.svg"></i>`);
            $(this).attr('sort', 'Ascen');
            var claims = SortClaims(getClaims(), ClaimsTipos(tipo), 'Ascen');
            SetClaims(claims);
        } else if (Coluna == 'Ascen') {
            resetArrows()
            $(this).html(tipo + ` <i class="Arrow Descen"><img src="../assets/arrow-down-solid.svg"></i>`);
            $(this).attr('sort', 'Descen');
            var claims = SortClaims(getClaims(), ClaimsTipos(tipo), 'Descen');
            SetClaims(claims);
        } else if (Coluna == 'Descen') {
            resetArrows()
            $(this).html(tipo);
            $(this).attr('sort', '');
            var claims = SortClaims(getClaims(), 'Seq', 'Ascen');
            SetClaims(claims);
        }
    }
});


function getClaims(){

    var leng = $(".Result").length;
    var Claim = Array.from({ length: leng } , () => ({ Seq: '', Status: '', LNC: '', Forn: '', Data: '', StatusSeis: '', Cod: '', Desc: '', ToDo: ''}))
    
    $(".Result").each(function (index, value) {
        // console.log(value.children[8].children[0].attributes[1])
        var i = index;

        Claim[index].Seq = Number(value.children[1].innerText);
        Claim[index].Status = value.children[2].innerText;
        Claim[index].LNC = value.children[3].innerText;
        Claim[index].Forn = value.children[4].innerText;
        Claim[index].Data = value.children[5].innerText;
        Claim[index].StatusSeis = Number(value.children[6].innerText);
        Claim[index].Cod = value.children[7].innerText;
        Claim[index].Desc = value.children[8].innerText;
        Claim[index].ToDo = value.children[9].innerText;
        Claim[index].FullDesc = value.children[8].children[0].attributes[1].nodeValue;
    })

    return Claim;
}

function SortClaims(obj, type, sort){
        
    var tipo = ""
    var nome = "";

    if (type == 'Seq' || type == 'StatusSeis'){
        tipo = "number"
    } else {
        tipo = "string"
    }

    nome = type;
    if (tipo == 'number'){
        //Organizar por números

        if (sort == "Ascen"){
            var organizarN = obj.sort((a, b) => {
                return a[nome] - b[nome];
            });
        } else if (sort == "Descen"){
            var organizarN = obj.sort((a, b) => {
                return b[nome] - a[nome];
            });
        }
        return organizarN;
    }

    if (tipo == 'string'){
        //Organizar por strings

        if (sort == "Ascen"){
            var organizarS = obj.sort((a, b) => {
                let fa = a[nome].toLowerCase(),
                fb = b[nome].toLowerCase();
        
                if (fa < fb) {
                    return -1;
                }
                if (fa > fb) {
                    return 1;
                }
                    return 0;
            });
        } else if (sort == "Descen"){
            var organizarS = obj.sort((a, b) => {
                let fa = a[nome].toLowerCase(),
                fb = b[nome].toLowerCase();
        
                if (fa > fb) {
                    return -1;
                }
                if (fa < fb) {
                    return 1;
                }
                    return 0;
            });
        }

        return organizarS;
    }
}

function SetClaims(obj) {

    var lenn = obj.length;

    for (var i = 0; i < lenn; i++)
    {
        var divv = `<div class="RowCell CellText Cellinfo"><i><img class="Icon Moon" src="../assets/circle-info-solid.svg" alt="" srcset=""></i></div>
        <div class="RowCell CellText CellSeq">${obj[i].Seq}</div>
        <div class="RowCell CellText CellStatus">${obj[i].Status}</div>
        <div class="RowCell CellText CellLNC">${obj[i].LNC}</div>
        <div class="RowCell CellText CellForn">${obj[i].Forn}</div>
        <div class="RowCell CellText CellData">${obj[i].Data}</div>
        <div class="RowCell CellText CellStatusSeis">${obj[i].StatusSeis}</div>
        <div class="RowCell CellText CellCod">${obj[i].Cod}</div>
        <div class="RowCell CellText CellDesc"><span reclam="${obj[i].FullDesc}" class="Desc">${obj[i].Desc}</span></div>
        <div class="RowCell CellText CelltoDo">${obj[i].ToDo}</div>`;

        $(`.S${i}`).html(divv);
    }
    StatusStyle();
    SeisStatusStyle();
    CompleteReclam();
}

function ClaimsTipos(Tipo){
    if (Tipo == 'Seq.') {
        return 'Seq';
    } else if (Tipo == 'Status') {
        return 'Status';
    } else if (Tipo == 'LNC') {
        return 'LNC';
    } else if (Tipo == 'Fornecedor') {
        return 'Forn';
    } else if (Tipo == 'Data') {
        return 'Data';
    } else if (Tipo == 'Status 60 dias') {
        return 'StatusSeis';
    } else if (Tipo == 'Código') {
        return 'Cod';
    } else if (Tipo == 'Motivo da Reclamação') {
        return 'Desc';
    } else if (Tipo == 'Status 8D') {
        return 'ToDo';
    }
}

function OpenClaim(LNC){
    console.log(LNC);
    $(".Popup").addClass("active");

    $(".LNCNum").html(LNC);

}

$('#SearchInput').on('keyup',function () { 
    removeElements();
  
    SortClaims = getClaims().sort();
  
    for (let i of SortForn) {
      if (
        i.toLowerCase().startsWith($('#SearchInput').val().toLowerCase()) &&
        $('#SearchInput').val() != ""
      ) {
        //create li element
        let listItem = document.createElement("span");
        //One common class name
        listItem.classList.add("SugBox");
        listItem.classList.add("Sug1");
        listItem.setAttribute("onclick", "displayNames('" + i + "')");
  
        //Display matched part in bold
        let word = "<b>" + i.substr(0, $('#Forn').val().length) + "</b>";
        word += i.substr($('#Forn').val().length);
  
        //display the value in array
        listItem.innerHTML = word;
        document.querySelector(".sugSpace").appendChild(listItem);
      }
    }
  
    
  });

  $(".not-icon").click(function (e) { 
    e.preventDefault();

    var notStatus = $(".not-list").hasClass('active');

    if (!notStatus){
        $(".not-list").addClass('active');
    } else if (notStatus){
        $(".not-list").removeClass('active');
    }
    
  });

var actualSlide = 1;

$('.foward-foto').click(function (e) { 
    e.preventDefault();
    
    function goFoward(){

        var filhos = $(".photos").children().length;
        var images = document.querySelectorAll('.img');

        $(".TotalPages").html(images.length);

        if (actualSlide < filhos) {
          images[actualSlide - 1].classList.remove("active");
          actualSlide++;
          $(".pag").removeClass('active');
          $(`.pag.p${actualSlide}`).addClass('active');
          images[actualSlide - 1].classList.add("active");
        } else if (actualSlide = filhos) {
          images[actualSlide - 1].classList.remove("active");
          actualSlide = 1;
          $(".pag").removeClass('active');
          $(`.pag.p${actualSlide}`).addClass('active');
          images[actualSlide - 1].classList.add("active");
        }
    }

    goFoward();
});

$('.back-foto').click(function (e) { 
    e.preventDefault();
    
    function goBack(){
        var filhos = $(".photos").children().length;
        var images = document.querySelectorAll('.img');
      
        $(".TotalPages").html(images.length);
        if (actualSlide > 1) {
          images[actualSlide - 1].classList.remove("active");
          actualSlide--;
          $(".pag").removeClass('active');
          $(`.pag.p${actualSlide}`).addClass('active');
          images[actualSlide - 1].classList.add("active");
          $(".ActualPage").html(actualSlide);
        } else if (actualSlide = 1) {
          images[actualSlide - 1].classList.remove("active");
          actualSlide = images.length;
          $(".pag").removeClass('active');
          $(`.pag.p${actualSlide}`).addClass('active');
          $(".ActualPage").html(actualSlide);
          images[actualSlide - 1].classList.add("active");
        }
    }

    goBack();
});

function PagGo(pag){

    var images = document.querySelectorAll('.img');

    $(".img").removeClass('active');
    images[pag - 1].classList.add("active");

    $(".pag").removeClass('active');
    $(`.pag.p${pag}`).addClass('active');
}

// $('.value').click(function (e) { 
//     e.preventDefault();
    
//     if (!$(this).hasClass('Editing')){

//         $(this).addClass('Editing')
//         var oldValue = $(this).html();
//         var origin = e.target.classList[0]
    
//         $(this).html(`<input type="text" name="" id="value-this" value="${oldValue}"> <div class="buttons"><button class="button-Save" onclick="saveThis('${origin}')">OK</button><button class="button-Forget" onclick="closeThis('${origin}', '${oldValue}')">X</button></div>`);
//     }

// });

function saveThis(classe){
    var newText = $("#value-this").val();

    $(`.${classe}`).removeClass('Editing');
    $(`.${classe}`).html(newText);
}

function closeThis(classe, oldValue){
    // console.log(classe);
    
    $(`.${classe}`).removeClass('Editing');
    // $(`.${classe}`).html(oldValue);
}


$(".close").click(function (e) { 
    e.preventDefault();
    
    if ($(".Popup").hasClass("active")){
        $(".Popup").removeClass("active");
    } 
});



function tabletoArr(){
    var Tabela = [];
    var rawTable = $(".Row.Result")
    var item = [];
    rawTable.each(function (index, element) { 
        var itens = element.children
        item[index] = {}
        itens = Array.from(itens).map((row) => {
            return row.innerText;
        })
        item[index].Seq = itens[1]; 
        item[index].Status = itens[2]; 
        item[index].LNC = itens[3]; 
        item[index].Forn = itens[4]; 
        item[index].Data = itens[5]; 
        item[index].Dias60 = itens[6]; 
        item[index].Cod = itens[7];
        item[index].Motivo = itens[8];
        item[index].Desc = itens[8];
        item[index].D8 = itens[9];   
    });

    Tabela = item

    return Tabela;
}


$(".SheetGen").click(function (e) { 
    e.preventDefault();

    const encodedData = encodeURIComponent(JSON.stringify(tabletoArr()));
    const url = `https://${webAjax}/testes/lnc/Ajax/excelExport.php?data=${encodedData}`;
    window.location.href = url;

});


function yearChange(e, year){
    if ($(e).hasClass("active")){
        return false;
    }

    $(".Year").removeClass("active");
    $(e).addClass("active");

    pageChange($(".page-item")[1], 1, true)
}



let currentPage = 1;
const itemsPerPage = 10;

function pageChange(e, pag, yearpass){

    if ($(e).hasClass("active") || yearpass){
        return false;
    }

    var year = $(".Year.active").attr("year");

    $.ajax({
    url: `https://${webAjax}/testes/lnc/Ajax/tablePags.php`, // URL do script PHP
    method: "GET",
    data: { year: year, page: pag, itemsPerPage: itemsPerPage },
    dataType: "json",
    success: function(data) {

        console.log(data);

        // $("#dataBody").empty();
        // data.items.forEach(item => {
        //     $("#dataBody").append(`<tr><td>${item.id}</td><td>${item.name}</td></tr>`);
        // });

        // // Construindo os botões de paginação:
        // $("#pagination").empty();
        //     for (let i = 1; i <= data.totalPages; i++) {
        //         $("#pagination").append(`<li class="page-item ${i === currentPage ? 'active' : ''}"><a class="page-link" href="#">${i}</a></li>`);
        //     }
        // }

        $(".page-item").removeClass("active");
        $(e).addClass("active");

    }, error: function (error) {
        console.error(error);
    }})

}

var ClaimBox = $(".Details");

let isDragging = false;
let startY;
let scrollTop;

ClaimBox.mousedown(function (e) { 
    isDragging = true;
    startY = e.clientY;
    scrollTop = ClaimBox.scrollTop();
});

document.addEventListener('mousemove', (e) => {
  if (!isDragging) return;

  const deltaY = e.clientY - startY;
  ClaimBox.scrollTop(scrollTop - deltaY);
});

document.addEventListener('mouseup', () => {
  isDragging = false;
});

// Evitar que o cursor do mouse se transforme em texto selecionável
ClaimBox.on("selectstart", function (e) {
    e.preventDefault();
});

// Evitar que o botão direito do mouse abra o menu de contexto
ClaimBox.on("contextmenu", function (e) {
    e.preventDefault();
});
