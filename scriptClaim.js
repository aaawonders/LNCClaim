

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