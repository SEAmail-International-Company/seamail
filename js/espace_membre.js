$(window).ready(function() {
    $("#modif_account").click(function() {
        $("#modal_modif_account").addClass("is-active");
    });
    $(".close_modif_account").click(function() {
      $("#modal_modif_account").removeClass("is-active");
    });
  });