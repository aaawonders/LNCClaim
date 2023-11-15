

var webAjax = "intranet.nidec.local"

// $(".btnn.addline").click(function (e) { 
//     e.preventDefault();
// });

$('#FormtoClaim').submit(function (e) { 
    e.preventDefault();
    
    var form = new FormData(this);
  
    $.ajax({
      type: "POST",
      url: `https://${webAjax}/testes/lnc/Ajax/formGO.php`,
      data: form,
      processData: false,
      contentType: false,
      success: function (response, status) {
  
        console.log(response);
        console.log(status);
  
        $('.PUp').removeClass('active');
        $('.blur').removeClass('active');
        $('.OpenClaim').removeClass('active');
  
        attTableClaim();
      },
      error: function (response) {
  
          console.log(response.responseText);
          alertarClaim('hrClaim', response.responseText);
      }
    });
  
  });

  $('#SubmitBtn').click(function (e) { 
    // e.preventDefault();
    
  var files = document.getElementById('FileImg').files;
  
  var ClaimOpen = {};
  
  ClaimOpen.LNC = $("#LNCNum").val();
  ClaimOpen.Forn = $("#Forn").val();
  
  
  ClaimOpen.Item = $("#CodItem").val();
  ClaimOpen.ItemDesc = $("#Item").val();
  
  
  ClaimOpen.Desc = $("#Desc").val();
  
  ClaimOpen.FileIndex = files.length;
  
  for (var i = 0; i < files.length; i++){
    ClaimOpen.Files[i] = files[i];
  }
  
  console.log(files);
  
  });

  var Forns = ['Ensinger', 'Igus', 'Deluma']

$('#Forn').on('keyup',function () { 
removeElements();

SortForn = Forns.sort();

for (let i of SortForn) {
if (
    i.toLowerCase().startsWith($('#Forn').val().toLowerCase()) &&
    $('#Forn').val() != ""
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

function displayNames(value) {
  $('#Forn').val(value);
  removeElements();
}

function removeElements() {
  //clear all the item
  let items = document.querySelectorAll(".SugBox");
  items.forEach((item) => {
    item.remove();
  });
}

LNCNum()

function LNCNum(){

  $.ajax({
    type: "get",
    url: `https://${webAjax}/testes/lnc/Ajax/getClaim.php`,
    data: "GETLNC",
    dataType: "json",
    success: function (response) {

      var lnc = response.LNC + 1
      var data = new Date();
      var ano = data.getFullYear().toString().substr(-2);
  
      var seq = 50;
  
      if (seq < 10){
          seq = '00' + seq;
      } else if (seq < 100){
          seq = '0' + seq;
      }
  
      $('#LNCNum').val(`${seq}/${ano}`);
    },
    error: function (response) {
      console.log(response);
    }
  });

}

$("#FileImg").change(function (e) { 
    e.preventDefault();

    var file = e.target.files[0];
    var quant = $(this)[0].files.length;

    console.log(file);

    $(".FileImgLabel").html(`Imagens selecionadas [${quant}]`);

    $("#ClearFiles").css("display", "block");
    
});

$("#ClearFiles").click(function (e) { 
    e.preventDefault();

    $("#FileImg").val(null);
    $(".FileImgLabel").html(`Adicionar imagens`);
    $("#ClearFiles").css("display", "none");
});


function addLine(e){
    e.preventDefault();
    var Rows = document.querySelector(".table-body").children;
    var RowsCount = Rows.length - 1;

    $('.btnn').removeClass('addline');
    $('.btnn').addClass('delline');
    $('.btnn').html('X')
    $('.btnn').attr('onclick', `remLine(event, ${RowsCount})`);

    var NewRow =  `<tr class="trow r-est r${RowsCount + 1}">
        <td class="title-row Sus">${RowsCount + 1}</td>
        <td class="input-row"><input type="text" class="input-table" name="Q-${RowsCount + 1}" id=""></td>
        <td class="input-row"><input type="text" class="input-table" name="N-${RowsCount + 1}" id=""></td>
        <td class="input-row"><input type="text" class="input-table" name="E-${RowsCount + 1}" id=""></td>
        <td class="input-row row-btn"><button onclick="addLine(event)" class="btnn addline">+</button></td>
    </tr>`

    $(".table-body").append(NewRow);
}

function remLine(e, line){
    e.preventDefault();

    $(`.r-est.r${line}`).remove();

    var Rows = document.querySelector(".table-body").children;

    for (var i = 0; i < Rows.length; i++){
      if (Rows[i].classList.contains("r-est")){

        var oldNum = Rows[i].classList[2].slice(1);
        Rows[i].classList.remove(`r${oldNum}`);
        Rows[i].classList.add(`r${i}`);
        
        Rows[i].children[0].innerHTML = i;
        var btndel = Rows[i].children[4].children[0]

        if (btndel.classList.contains('delline')){
          btndel.setAttribute("onclick", `remLine(event, ${i})`);
        }


      }
    }
}



$('#Q-1').on('keypress', function (e) {
    
    var valor = $(this).val();

    if (!isNAN(valor)){
        console.log(valor);
    
        valor = parseFloat(valor).toFixed(2);
    
        // console.log(valor);
    
        $(this).val(valor);
    }
});

var Componets = JSON.parse(`[
  {
    "cod": "C 100 010",
    "name": "Carcaça Bruta BA EA211",
    "draw": "04E 121 042AE",
    "prod" : "VW 01 30",
    "Sup": "STAY"
  },
  {
    "cod": "C 018 003",
    "name": "Tampa Deckel BA EA211",
    "draw": "04E 121 148D",
    "prod" : "VW 01 30",
    "Sup": "Scheuermann"
  },
  {
    "cod": "C 002 015",
    "name": "Rolamento BA EA211",
    "draw": "04E 121 015A",
    "prod" : "VW 01 30",
    "Sup": "Schaeffler"
  },
  {
    "cod": "C 004 005",
    "name": "Rotor BA EA211",
    "draw": "04E 121 121C",
    "prod" : "VW 01 30",
    "Sup": "Ensinger"
  },
  {
    "cod": "C 003 014",
    "name": "Selo Lip-Seal HPS BA EA211",
    "draw": "04E 121 539E",
    "prod" : "VW 01 30",
    "Sup": "EKK Simrax"
  },
  {
    "cod": "C 005 009",
    "name": "Polia Dentada BA EA211",
    "draw": "04E 109 111AE",
    "prod" : "VW 01 30",
    "Sup": "Miba Mahle"
  }
  ,
  {
    "cod": "C 011 002",
    "name": "Pistão BO EA211",
    "draw": "154 017 802KT",
    "prod" : "VW 02 04",
    "Sup": "Igus"
  },
  {
    "cod": "C 012 002",
    "name": "Mola BO EA211",
    "draw": "423 011 801",
    "prod" : "VW 02 04",
    "Sup": "Igus"
  }
]`);

function LoadAllComp(){
  var prods = Componets.map(({prod}) => {return prod})
  console.log(prods)

  prods = prods.filter(function(item, pos, self) {
    return self.indexOf(item) == pos;
  })

  $(".ProdutsList ul").empty();
  $(".ComponentsList ul").empty();
  prods.forEach(function (value, index) { 
    $(".ProdutsList ul").append(`<li cod="${value}" onclick="LoadProd(this)" class="Prod-choose Prod${index}">${value}</li>`)
  });
  
}

 $(document).ready(function () {
  LoadAllComp();
 });


function StoreItem(cod){
  var btngo = $(".btn-go-item")

  if (cod == undefined || cod == null){
    btngo.removeClass("item-choosen");
    btngo.attr('cod', '');
    return false;
  }

  btngo.addClass("item-choosen");
  btngo.attr('cod', cod);

}


function LoadProd(e){

  if (e.classList.contains('active')){
    return false;
  }

  $(".Prod-choose").removeClass("active");

  $(e).addClass("active");
  $(".ComponentsList ul").empty();

  var prod = $(e).attr('cod')
  var prodjson = Componets.filter((word) => word.prod == prod);

  prodjson.forEach(function (value, index) { 
    console.log(value);
    $(".ComponentsList ul").append(`<li cod="${value.cod}" onclick="LoadComp(this)" class="Comp-choose Comp${index}">${value.cod}</li>`)
  });

  $('.Comp-choose').off();

  $('.Comp-choose').hover(function () {

    if (this.classList.contains('active')){
      return false;
    }
  
    var comp = $(this).attr('cod')
    var compjson = Componets.filter((word) => word.cod == comp)
    console.log(compjson);
    
    $(this).attr('after-content', compjson[0].name)
      
    }, function () {
      // out
    }
  );
}


function LoadComp(e){

  if (e.classList.contains('active')){
    $(e).removeClass("active");
    $(".dot-info-comp").remove();
    StoreItem(null)
    return false;
  }

    $(".Comp-choose").removeClass("active");

    $(e).addClass("active");

    var cod = $(e).attr("cod");

    $(".dot-info-comp").remove();
    $(e).append(`<span class="dot-info-comp" onclick="LoadInfoComp('${cod}')">...</span>`);
    StoreItem(cod)

    $(document).keypress(function (e) { 
      if(e.which == 13 || $(".btn-go-item").attr("cod") !== "") {
        $(".btn-go-item").click()
    }
    });
}


function LoadInfoComp(cod){
  var compjson = Componets.filter((word) => word.cod == cod)
  console.log(compjson);
}




$('#searchparts').keypress(function (e) { 

  var searchTerm = e.target.value.toLowerCase();


  // console.log(searchTerm);

  var filteredObjects = Componets.filter(function(objeto) {
    // Verifica se o termo de pesquisa está presente em qualquer propriedade do objeto
    for (var key in objeto) {
      if (objeto[key].toLowerCase().includes(searchTerm)) {
        return true;
      }
    }
    return false;
  });

  $(".ComponentsList ul").empty();

  if (filteredObjects.length === 0) {
    console.log("Nenhum resultado encontrado.");
  } else {
    filteredObjects.forEach(function(objeto, index) {
      $(".ComponentsList ul").append(`<li cod="${objeto.cod}" onclick="LoadComp(this)" class="Comp-choose Comp${index}">${objeto.cod}</li>`)

      $('.Comp-choose').off();

      $('.Comp-choose').hover(function () {
    
        if (this.classList.contains('active')){
          return false;
        }
      
        var comp = $(this).attr('cod')
        var compjson = Componets.filter((word) => word.cod == comp)
        console.log(compjson);
        
        $(this).attr('after-content', compjson[0].name)
          
        }, function () {
          // out
        }
      );
    });
  }



// Adiciona um event listener para atualizar os resultados a cada keypress
// document.getElementById("searchInput").addEventListener("input", updateResults);

//   var sortComp = Componets.sort();
  
//   console.log(sortComp);

// for (let i of sortComp) {

//   sortComp.find();
//   // if (
//   //     i.toLowerCase().startsWith($('#searchparts').val().toLowerCase()) &&
//   //     $('#searchparts').val() != ""
//   // ) {
//   //     //create li element
//   //     let listItem = document.createElement("span");
//   //     //One common class name
//   //     listItem.classList.add("SugBox");
//   //     listItem.classList.add("Sug1");
//   //     listItem.setAttribute("onclick", "displayNames('" + i + "')");

//   //     //Display matched part in bold
//   //     let word = "<b>" + i.substr(0, $('#Forn').val().length) + "</b>";
//   //     word += i.substr($('#Forn').val().length);

//   //     //display the value in array
//   //     listItem.innerHTML = word;
//   //     document.querySelector(".sugSpace").appendChild(listItem);
//   // }
// }


});


function ChooseComp(e){
  var comp = $(e).attr('cod')
  if (comp == "" || comp == undefined) return false;

  var compjson = Componets.filter((word) => word.cod == comp)
  $(".PartsPop").css("display","none");

  $("#CodItem").val(compjson[0].cod);
  $("#Item").val(compjson[0].name + " (Desenho: " + compjson[0].draw + ")");
  $("#Forn").val(compjson[0].Sup);
}