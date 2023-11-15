$(".ChangeType").click(function (e) { 
    e.preventDefault();

    $(".ChangeType").removeClass("active");
    
    if ($(this).hasClass("Comp")) {
        console.log("Comp");

        $(this).addClass("active");
    }

    if ($(this).hasClass("Forn")) {
        console.log("Forn");

        $(this).addClass("active");
    }

});


$(".Add-Item").click(function (e) { 
    e.preventDefault();
    
    $(".input-table").removeClass("none");
    $(".input-table").addClass("active");

});