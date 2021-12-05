function changeInputStatus(inputType, toDanger){
    var statebox = $("#statebox_"+inputType);
    var input = $("#"+inputType);

    if(toDanger){
        statebox.removeClass("is-success");
        input.removeClass("is-success");
        statebox.addClass("is-danger");
        input.addClass("is-danger");
    }else{
        statebox.removeClass("is-danger");
        input.removeClass("is-danger");
        statebox.addClass("is-success");
        input.addClass("is-success");
    }
}