LNCNum();

console.log(DataHoje())

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
    var ano = data.getYear();

    var seq = 12;

    if (seq < 100){
        seq = '0' + seq;
    } else if (seq < 10){
        seq = '00' + seq;
    }

    $('#LNCNum').val(`${seq}/${ano}`);
}

function DataHoje() {
    
    var data = new Date("1991-12-5"); //.toLocaleDateString('en-GB');

    return data.getYear();
}

$(".ThemeMode").click(function (e) { 
    e.preventDefault();
    
    var Theme = document.querySelector('.ThemeMode');
    var HasMoon = $(".ThemeMode").hasClass("Moon");
    var HasSun = $(".ThemeMode").hasClass("Sun");

    if (HasMoon == true) {
        $("body").css("background-color", "var(--black-space)");
        $("body").css("color", "var(--black-font)");

        $(".ThemeMode").removeClass("Moon");
        $(".ThemeMode").addClass("Sun");

        $(".Icon.Moon").css("display", "none");
        $(".Icon.Sun").css("display", "block");

        $(":root").css("--second-back", "rgb(38, 50, 65)");
    }

    if (HasSun == true) {
        $("body").css("background-color", "var(--white-space)");
        $("body").css("color", "var(--white-font)");

        $(".ThemeMode").removeClass("Sun");
        $(".ThemeMode").addClass("Moon");

        $(".Icon.Moon").css("display", "block");
        $(".Icon.Sun").css("display", "none");

        $(":root").css("--second-back", "rgb(184, 184, 184)");
    }
    
});


$("#FileImg").change(function (e) { 
    e.preventDefault();

    var file = e.target.files[0];
    var quant = $(this)[0].files.length;

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

$('.Result.S1').click(function (e) { 
    e.preventDefault();

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