$(function () {
  $("#navbar-toggler").on("click", function () {
    $("#menuModal").modal("show");
  });
  $(window).on("resize", function () {
    $("#menuModal").modal("hide");
  });

  if ("{{ $errors->first('permisos') }}") {
    $("#permisos").show();

    setTimeout(function () {
      $("#permisos").fadeOut("slow");
    }, 3000);
  }
});
