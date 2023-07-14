$(document).ready(function () {
  attTableClaim();
});

function attTableClaim(){
  $.ajax({
    type: "POST",
    url: "https://192.168.0.190/testes/lnc/Ajax/AttTable.php",
    data: "",
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
    
        console.log('teste');
        $('.PUp').addClass('active');
        $('.blur').addClass('active');
        $('.ClaimInfo').addClass('active');
    
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
    url: "https://192.168.0.190/testes/lnc/Ajax/Ajax/formGO.php",
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


// $.ajax({
//   type: "method",
//   url: "url",
//   data: "data",
//   dataType: "dataType",
//   success: function (response) {
    
//   }
// });

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



var Claim = {}

Claim.LNC = "001/23";
Claim.Data = "01/01/2023"

Claim.Forn = "Ensinger Indústria de Plásticos Técnicos Ltda."
Claim.FornCont = "Carlos Leandro L. da Rosa";
Claim.FornTel = "(51) 3579-8834";
Claim.FornEmail = "carlos@ensinger.com.br";

Claim.Customer = "Nidec"
Claim.CustCont = "André Silva";
Claim.CustTel = "(19) 3936-8483";
Claim.CustEmail = "andre.silva@nidec-gpm.com";

Claim.Item = "C 001 017";
Claim.ItemDesc = "Carcaça Plástica VW EA 211 (04E 121 1171L)";

Claim.Desc = "Peças sem as buchas.";
Claim.DescEsp = "Peças com as buchas inseridas";
Claim.DescEnc = "Peças sem todas as buchas.";

Claim.Annex = 2;


$('.Result').on('click', function (e) { 
    e.preventDefault();

    console.log('teste');
    $('.PUp').addClass('active');
    $('.blur').addClass('active');
    $('.ClaimInfo').addClass('active');

})

$('#OKBtn').click(function (e) { 
    e.preventDefault();
    
    $('.PUp').removeClass('active');
    $('.blur').removeClass('active');
    $('.ClaimInfo').removeClass('active');


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
});

$('.ImgZone').click(function (e) { 
  e.preventDefault();

  $('.Imgs').addClass('active');
  // $('.ClaimInfo').removeClass('active');

})

$('.btnclose').click(function (e) { 
  e.preventDefault();

  $('.Imgs').removeClass('active');

})

// Gráficos

const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['Ensinger', 'Deluma'],
      datasets: [{
        label: 'Reclamações',
        data: [2, 7],
        borderWidth: 0.5
      }]
    },
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
  });

  const ctx2 = document.getElementById('myChart2');

Chart.defaults.color = '#000';

  new Chart(ctx2, {
    type: 'bar',
    data: {
      labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun'],
      datasets: [{
        label: 'Reclamações',
        data: [2, 10, 2, 4, 7, 9],
        borderWidth: 0
      }]
    },
    options: {
      responsive: true,
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
  });

  // Slide Show Claim

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
