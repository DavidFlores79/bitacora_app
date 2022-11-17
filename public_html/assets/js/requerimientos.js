var app = angular.module("requerimientos", [
  "angularUtils.directives.dirPagination",
]);
app.controller("requerimientos", function ($scope, $http, $window) {
  $scope.currentPage = 1;
  $scope.pageSize = 9;

  $scope.estados = {
    registrado: estatus.registrado,
    en_proceso: estatus.en_proceso,
    en_espera: estatus.en_espera,
    asignado: estatus.asignado,
    resuelto: estatus.resuelto,
  };

  $http({
    url: "requerimientos/getRequerimientos",
    method: "GET",
    headers: {
      "Content-Type": "application/json",
    },
  }).then(
    function successCallback(response) {
      console.log(response);
      $scope.tickets = response.data.tickets;
      $scope.ticketsAll = response.data.ticketsAll;
      $scope.ticketsCerrados = response.data.ticketsCerrados;
      $scope.ticketsVencidos = response.data.ticketsVencidos;
      $scope.proyectos = response.data.proyectos;
      $scope.ticket_tipos = response.data.ticket_tipos;
      $scope.prioridades = response.data.prioridades;
      $scope.grupos = response.data.grupos;
      $scope.especialistas = response.data.especialistas;
      $scope.categorias = response.data.categorias;
      $scope.servicios = response.data.servicios;
    },
    function errorCallback(response) {
      console.log("Error: ", response);
      swal(
        titulos.gestion_tickets,
        mensajes.error_getData,
        tiposDeMensaje.error
      );
    }
  );

  $scope.moduloProv = function (modulo, usuario) {
    let form = document.createElement("form");
    form.action = "requerimientos/ver-ticket/";
    form.method = "GET";
    form.innerHTML = '<input type="hidden" name="id" value="'+modulo+'"> <input type="hidden" name="idticket" value="'+usuario+'">';
    document.body.append(form);

    form.submit();
  };

  $scope.modalEditar = function (Id) {
    $http({
      url: "gestion-tickets/" + +Id + "/edit",
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
    }).then(
      function successCallback(response) {
        $scope.ticket = response.data.ticket[0];
        $("#mdl_edit_tickets").modal("show");
        //console.log($scope.ticket);
      },
      function errorCallback(response) {
        console.log("hubo error: ", response);
        swal(
          titulos.gestion_tickets,
          response.data.message,
          tiposDeMensaje.error
        );
      }
    );
  };

});
