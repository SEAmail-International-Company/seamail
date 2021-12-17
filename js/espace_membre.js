$(window).ready(function() {
    $("#modif_account").click(function() {
        $("#modal_modif_account").addClass("is-active");
    });
    $(".close_modal_modif_account").click(function() {
      $("#modal_modif_account").removeClass("is-active");
    });
    
    $("#create_salon").click(function() {
      $("#modal_create_salon").addClass("is-active");
    });
    $(".close_modal_create_salon").click(function() {
      $("#modal_create_salon").removeClass("is-active");
    });
  });