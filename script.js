
var webAjax = "192.168.15.14"

$(document).ready(function () {  
  attTableClaim();
  attTableBy();
  
  updateCharts();

  window.onkeydown = function( event ) {
    if ( event.keyCode == 27 ) {
      if ($('.PUp').hasClass('active')){      
        $('.PUp').removeClass('active');
        $('.blur').removeClass('active');
        $('.ClaimInfo').removeClass('active');

        $('.ImgZone').off();
        $('#OKBtn').off();
        $('.blur').off();
        $('.btnclose').off();
    
        if ($('.Imgs').hasClass('active')){
          $('.Imgs').removeClass('active');
          $('.imgShow').html('');
        }
      }
    }
  };
});

var labels1 = [];
var labels2 = [];
var values1 = [];
var values2 = [];

setInterval(() => {
  attTableBy();
}, 840000);

function attTableBy(){
  $.ajax({
    type: "GET",
    url: `https://${webAjax}/testes/lnc/Ajax/AttTable.php`,
    data: "AttTableBy=true",
    dataType: "html",
    beforeSend: function () {
      // $('.Row.Result').remove();
      // $('.TableClaim').append('<span class="Wait">Loading...</span>');
    },
    success: function (response) {

      $(".UpdateIn span").html(response);
    },
    error: function (response) {
      $('.Wait').remove();
      $('.TableClaim').append(response);
    }
  });
}

function attTableClaim(){
  $.ajax({
    type: "GET",
    url: `https://${webAjax}/testes/lnc/Ajax/AttTable.php`,
    data: "Table=true",
    dataType: "html",
    beforeSend: function () {
      $('.Row.Result').remove();
      $('.TableClaim').append('<span class="Wait">Loading...</span>');
    },
    success: function (response) {
      
      $('.Wait').remove();
      $('.TableClaim').append(response);

      if ($('.Row.Result').html() == response){
        console.log('Success')
      } else {
        console.log('Error');
      }

      $('.Result').on('click', function (e) { 
        e.preventDefault();
    
        $('.PUp').addClass('active');
        $('.blur').addClass('active');
        $('.ClaimInfo').addClass('active');

        attTableBy();
    
    })
    
    },
    error: function (response) {
      $('.Wait').remove();
      $('.TableClaim').append(response);
    }
  });
}


setInterval(function () {
  var claims = document.querySelectorAll('.Row.Result');
},1000)

function alertarClaim(classes, message){
  $(`.${classes}`).after(`<div class="alertar alert alert-danger w-100" role="alert">
  teste
  </div>`);
  $('.alertar').html(message);
}

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


LNCNum();

console.log(DataHoje())

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

// $('.SugBox').click(function (e) { 
//   e.preventDefault();

//   console.log(e);

//   // var text = e.target.outerText;

//   // $('#Forn').val(text);

// });

$('#OpenButton').click(function (e) { 
    e.preventDefault();
    
    $('.PUp').addClass('active');
    $('.blur').addClass('active');
    $('.OpenClaim').addClass('active');

});


$('#CancelBtn').click(function (e) { 
    e.preventDefault();
    
    $('.PUp').removeClass('active');
    $('.blur').removeClass('active');
    $('.OpenClaim').removeClass('active');

});

function LNCNum(){

    var data = new Date();
    var ano = data.getFullYear().toString().substr(-2);

    var seq = 50;

    if (seq < 10){
        seq = '00' + seq;
    } else if (seq < 100){
        seq = '0' + seq;
    }

    $('#LNCNum').val(`${seq}/${ano}`);
}

function DataHoje() {
    
    var data = new Date("1991-12-5"); //.toLocaleDateString('en-GB');

    return data.getYear();
}

function ThemeGet (){
  var cookies = document.cookie

  cookies = cookies.split('; ');

  
}

function ThemeChange(Type, click){

  if (Type === "Sun") {
    $("body").css("background-color", "var(--black-space)");
    $("body").css("color", "var(--black-font)");

    $(".ThemeMode").removeClass("Moon");
    $(".ThemeMode").addClass("Sun");

    $(".Icon.Moon").css("display", "none");
    $(".Icon.Sun").css("display", "block");

    $(":root").css("--second-back", "rgb(38, 50, 65)");
    $(":root").css("--highlight-back", "rgb(35, 60, 90)");
  } else if (Type === "Moon") {
    $("body").css("background-color", "var(--white-space)");
    $("body").css("color", "var(--white-font)");

    $(".ThemeMode").removeClass("Sun");
    $(".ThemeMode").addClass("Moon");

    $(".Icon.Moon").css("display", "block");
    $(".Icon.Sun").css("display", "none");

    $(":root").css("--second-back", "rgb(184, 184, 184)");
    $(":root").css("--highlight-back", "rgb(233, 233, 233)");
  }

  if (click === true) {
    if (Type === "Sun") {
      document.cookie = "ThemeSession=Moon";
  } else if (Type === "Moon"){
      document.cookie = "ThemeSession=Sun";
  }
}
}

$(".ThemeMode").click(function (e) { 
    e.preventDefault();
    
    var Theme = document.querySelector('.ThemeMode');
    var HasMoon = $(".ThemeMode").hasClass("Moon");
    var HasSun = $(".ThemeMode").hasClass("Sun");

    if (HasMoon == true) {
      ThemeChange('Sun', true)
    }

    if (HasSun == true) {
      ThemeChange('Moon', true)
    }

});


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

function PopClaim (LNC) { 

$.ajax({
  type: "get",
  url: `https://${webAjax}/testes/lnc/Ajax/getClaim.php`,
  data: `LNC=${LNC}`,
  dataType: "json",
  beforeSend: function () {

    $('.PUp').addClass('active');
    $('.blur').addClass('active');
    $('.ClaimInfo').addClass('active');

    $('.loading.claim').addClass('active');
  },
  success: function (response) {

  var RawClaim = response;
  
  var Claim = {}
  
  Claim.LNC = RawClaim.LNC;

  Claim.Data = RawClaim.Data;
  
  Claim.Forn = RawClaim.Forn_Cont.Nome;
  Claim.FornCont = RawClaim.Forn_Cont.Contato;
  Claim.FornTel = RawClaim.Forn_Cont.Telefone;
  Claim.FornEmail = RawClaim.Forn_Cont.Email;
  
  Claim.Customer = RawClaim.Nidec_Cont.Nome;
  Claim.CustCont = RawClaim.Nidec_Cont.Contato;
  Claim.CustTel = RawClaim.Nidec_Cont.Telefone;
  Claim.CustEmail = RawClaim.Nidec_Cont.Email;
  
  Claim.Item = RawClaim.Item;
  // Claim.ItemDesc = "Carcaça Plástica VW EA 211 (04E 121 1171L)";
  
  Claim.Desc = RawClaim.Descricao;
  // Claim.DescEsp = "Peças com as buchas inseridas";
  // Claim.DescEnc = "Peças sem todas as buchas.";
  
  Claim.Annex = Number(RawClaim.Files.FileQuant);

  Claim.File = []

  if (Claim.File !== 0){
    for (var i = 0; i < RawClaim.Files.File.length; i++){
      Claim.File[i] = `https://${webAjax}/testes/lnc/data` + RawClaim.Files.File[i]
    }

  }

  $(".DataRes").html(Claim.Data);
  $(".LNCRes").html(Claim.LNC);

  $(".FornName").html(Claim.Forn);
  $(".FornCont").html(Claim.FornCont);
  $(".FornTel").html(Claim.FornTel);
  $(".linkEmailForn").html(Claim.FornEmail);
  $(".linkEmailForn").attr('href', `mailto:${Claim.FornEmail}`);


  $(".CustName").html(Claim.Customer);
  $(".CustCont").html(Claim.CustCont);
  $(".CustTel").html(Claim.CustTel);
  $(".linkEmailCust").html(Claim.CustEmail);
  $(".linkEmailCust").attr('href', `mailto:${Claim.CustEmail}`);

  $(".ItemRes").html(Claim.Item);
  $(".ItemDescRes").html(Claim.ItemDesc);

  $(".DescRes").html(Claim.Desc);
  $(".EncRes").html(Claim.DescEnc);
  $(".EspRes").html(Claim.DescEsp);

  $(".ImgZone").html(Claim.Annex);
  
  function closeAll(){
    $('.PUp').removeClass('active');
    $('.blur').removeClass('active');
    $('.ClaimInfo').removeClass('active');

    $('.ImgZone').off();
    $('#OKBtn').off();
    $('.blur').off();
    $('.btnclose').off();

    if ($('.Imgs').hasClass('active')){
      $('.Imgs').removeClass('active');
      $('.imgShow').html('');
    }
  }
  
  $('#OKBtn').click(function (e) { 
      e.preventDefault();
      closeAll()
  });

  $('.blur').click(function (e) { 
    e.preventDefault();
    closeAll()
});

  function addImg(imgs){
    for (var i = 0; i < imgs.length; i++){
      $('.imgShow').append(`<img class="imge i${i}" src="${imgs[i]}" alt="">`);
    }

    $('.imge.i0').addClass('active');
    $('.TotalPages').html(imgs.length);
    $('.ActualPage').html('1');
  }



  $('.ImgZone').click(function (e) { 
    e.preventDefault();

    if (Claim.Annex !== 0){
      addImg(Claim.File)
      
      $('.Imgs').addClass('active');
      // $('.ClaimInfo').removeClass('active');
    }
  
  })
  
  $('.btnclose').click(function (e) { 
    e.preventDefault();
  
    $('.Imgs').removeClass('active');
  
  })

  $('.loading.claim').removeClass('active');
  $('.InfoZone').addClass('active');

  },
  error: function (response){
    var RawClaim = response;

    console.log(RawClaim);
  }
});
}

// $('.Result').on('click', function (e) { 
//   // e.preventDefault();

//   PopClaim (2);
// })

// var Claim = {}
  
//   Claim.LNC = "001/23";
//   Claim.Data = "01/01/2023"
  
//   Claim.Forn = "Ensinger Indústria de Plásticos Técnicos Ltda."
//   Claim.FornCont = "Carlos Leandro L. da Rosa";
//   Claim.FornTel = "(51) 3579-8834";
//   Claim.FornEmail = "carlos@ensinger.com.br";
  
//   Claim.Customer = "Nidec"
//   Claim.CustCont = "André Silva";
//   Claim.CustTel = "(19) 3936-8483";
//   Claim.CustEmail = "andre.silva@nidec-gpm.com";
  
//   Claim.Item = "C 001 017";
//   Claim.ItemDesc = "Carcaça Plástica VW EA 211 (04E 121 1171L)";
  
//   Claim.Desc = "Peças sem as buchas.";
//   Claim.DescEsp = "Peças com as buchas inseridas";
//   Claim.DescEnc = "Peças sem todas as buchas.";
  
//   Claim.Annex = 2;
  
  
//   $('.Result').on('click', function (e) { 
//       e.preventDefault();
  
//       console.log('teste');
//       $('.PUp').addClass('active');
//       $('.blur').addClass('active');
//       $('.ClaimInfo').addClass('active');
  
//   })
  
//   $('#OKBtn').click(function (e) { 
//       e.preventDefault();
      
//       $('.PUp').removeClass('active');
//       $('.blur').removeClass('active');
//       $('.ClaimInfo').removeClass('active');
  
  
//       $(".DataRes").html(Claim.Data);
//       $(".LNCRes").html(Claim.LNC);
  
//       $(".FornName").html(Claim.Forn);
//       $(".FornCont").html(Claim.FornCont);
//       $(".FornTel").html(Claim.FornTel);
//       $(".linkEmailForn").html(Claim.FornEmail);
//       $(".linkEmailForn").attr('href', `mailto:${Claim.FornEmail}`);
  
  
//       $(".CustName").html(Claim.Customer);
//       $(".CustCont").html(Claim.CustCont);
//       $(".CustTel").html(Claim.CustTel);
//       $(".linkEmailCust").html(Claim.CustEmail);
//       $(".linkEmailCust").attr('href', `mailto:${Claim.CustEmail}`);
  
//       $(".ItemRes").html(Claim.Item);
//       $(".ItemDescRes").html(Claim.ItemDesc);
  
//       $(".DescRes").html(Claim.Desc);
//       $(".EncRes").html(Claim.DescEnc);
//       $(".EspRes").html(Claim.DescEsp);
  
//       $(".ImgZone").html(Claim.Annex);
//   });
  
//   $('.ImgZone').click(function (e) { 
//     e.preventDefault();
  
//     $('.Imgs').addClass('active');
//     // $('.ClaimInfo').removeClass('active');
  
//   })
  
//   $('.btnclose').click(function (e) { 
//     e.preventDefault();
  
//     $('.Imgs').removeClass('active');
  
//   })


// Gráficos
const data = {
  labels: labels1,
  datasets: [{
    label: 'Reclamações',
    data: values1,
    borderWidth: 0.5,
    borderColor: '#eb4637',
    backgroundColor: '#f5a899',
  }]
};

const config = {
  type: 'doughnut',
  data: data,
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: {
          display: false
      },            
      title: {
          display: true,
          text: 'Reclamações de 2023 por fornececedor',
          color: '#000000'
      }
    },
    layout: {
      padding: 5,
    }
  }
};

const ctx = new Chart(document.getElementById('myChart'),config);

const data2 = {
  labels: labels2,
  datasets: [{
    label: 'Reclamações',
    data: values2,
    borderWidth: 0.5,
    borderColor: '#4c37eb',
    backgroundColor: '#99a1f5',
  }]
};

const config2 = {
  type: 'bar',
  data: data2,
  options: {     responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: {
          display: false
      },            
      title: {
          display: true,
          text: 'Número de Reclamações por mês',
          color: '#000000'
      },
      datalabels: {
          color: 'black',
          font: {
            weight: 'bold'
          }
      },
    },
    layout: {
      padding: 5,
    }
  }
};

const ctx2 = new Chart(document.getElementById('myChart2'), config2);

var actualSlide = 1;



$(".GoBack").click(function (e) { 
  e.preventDefault();
  
  var filhos = $(".imgShow").children().length;
  var images = document.querySelectorAll('.imge');

  $(".TotalPages").html(images.length);
  if (actualSlide > 1) {
    images[actualSlide - 1].classList.remove("active");
    actualSlide--;
    images[actualSlide - 1].classList.add("active");
    $(".ActualPage").html(actualSlide);
  } else if (actualSlide = 1) {
    images[actualSlide - 1].classList.remove("active");
    actualSlide = images.length;
    $(".ActualPage").html(actualSlide);
    images[actualSlide - 1].classList.add("active");
  }

});

$(".GoFor").click(function (e) { 
  e.preventDefault();
  
  var filhos = $(".imgShow").children().length;
  var images = document.querySelectorAll('.imge');

  $(".TotalPages").html(images.length);
  if (actualSlide < filhos) {
    images[actualSlide - 1].classList.remove("active");
    actualSlide++;
    $(".ActualPage").html(actualSlide);
    images[actualSlide - 1].classList.add("active");
  } else if (actualSlide = filhos) {
    images[actualSlide - 1].classList.remove("active");
    actualSlide = 1;
    $(".ActualPage").html(actualSlide);
    images[actualSlide - 1].classList.add("active");
  }

})


function random_rgba() {
  var o = Math.round, r = Math.random, s = 255;
  return 'rgba(' + o(r()*s) + ',' + o(r()*s) + ',' + o(r()*s) + ',' + r().toFixed(1) + ')';
}

$(".updateChart.Up").click(function (e) { 
  e.preventDefault();
  updateCharts();
});


function updateCharts(){

  if (!$(".updateChart").hasClass('Loading')){
    $.ajax({
      type: "POST",
      url: `https://${webAjax}/testes/lnc/Ajax/AttChart.php`,
      data: "data",
      dataType: "json",    
      beforeSend: function () {
        $(".Icon.Update.Chart").remove();
        $(".updateChart").removeClass('Up');
        $(".updateChart").addClass('Loading');
        $(".updateChart").append(`<div class="spinner-border chart text-secondary" role="status" style="width: 24px; height: 24px;"><span class="visually-hidden">Loading...</span></div>`);
      },
      success: function (response) {
        dataAno = response.yearly;
        dataMes = response.monthly;
  
        labels1 = dataMes.names;
        values1 = dataMes.values;
        ctx.data.labels = labels1;
        ctx.data.datasets[0].data = values1;
        ctx.update();
  
        labels2 = dataAno.names;
        values2 = dataAno.values;
        ctx2.data.labels = labels2;
        ctx2.data.datasets[0].data = values2;
        ctx2.update();
  
        // attChart(ctx, dataMes.names, dataMes.values);
  
        $(".updateChart").removeClass('Loading');
        $(".updateChart").addClass('Up');
        $(".spinner-border.chart").remove();
        $(".updateChart").append(`<img class="Icon Update Chart" src="./assets/rotate-right-solid.svg" alt="" srcset="">`);
      }, error: function(response) {
          console.error(response.responseText);
          $(".updateChart").removeClass('Loading');
          $(".updateChart").addClass('Up');
          $(".spinner-border.chart").remove();
          $(".updateChart").append(`<img class="Icon Update Chart" src="./assets/rotate-right-solid.svg" alt="" srcset="">`);
      }
    });
  }
}


