$(window).ready(function() {
    $("#modif_account").click(function() {
        $("#modal_modif_account").addClass("is-active");
    });
    $(".close_modif_account").click(function() {
      $("#modal_modif_account").removeClass("is-active");
      $("#mail").addClass("is-static");
      $('#mail').attr('readonly', true);
      $("#edit-mail").show();
      $("#score").addClass("is-static");
      $('#score').attr('readonly', true);
      $("#edit-score").show();
      $("#rang").addClass("is-static");
      $('#rang').attr('readonly', true);
      $("#edit-rang").show();
    });
    $("#edit-mail").click(function() {
      $("#mail").removeClass("is-static");
      $('#mail').attr('readonly', false);
      $(this).hide();
    });
    $("#edit-score").click(function() {
      $("#score").removeClass("is-static");
      $('#score').attr('readonly', false);
      $(this).hide();
    });
    $("#edit-rang").click(function() {
      $("#rang").removeClass("is-static");
      $('#rang').attr('readonly', false);
      $(this).hide();
    });
  });