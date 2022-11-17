var app = angular.module("ticket", ["angularUtils.directives.dirPagination"]);
app.controller("ticket", function ($scope, $http, $window) {
  $scope.currentPage = 1;
  $scope.pageSize = 9;
  $scope.idTicket = idTicket;
  $scope.estados = {
    registrado: estatus.registrado,
    en_proceso: estatus.en_proceso,
    en_espera: estatus.en_espera,
    asignado: estatus.asignado,
    resuelto: estatus.resuelto,
  };

  $http({
    url: "ver-ticket/" + $scope.idTicket + "/getTicket",
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
  }).then(
    function successCallback(response) {
      $scope.estatus = new Array();
      $scope.ticket = response.data.ticket;
      console.log($scope.ticket);
      $scope.proyectos = response.data.proyectos;
      $scope.ticket_tipos = response.data.ticket_tipos;
      $scope.prioridades = response.data.prioridades;
      $scope.grupos = response.data.grupos;
      $scope.especialistas = response.data.especialistas;
      $scope.categorias = response.data.categorias;
      $scope.servicios = response.data.servicios;
      var status = response.data.estatus;

      if ($scope.ticket.estatus_id == 1) {
        for (i = 0; i < status.length; i++) {
          if (status[i].id == 1) $scope.estatus.push(status[i]);
          if (status[i].id == 7) $scope.estatus.push(status[i]);
        }
      }
      if ($scope.ticket.estatus_id == 2) {
        for (i = 0; i < status.length; i++) {
          if (status[i].id == 2) $scope.estatus.push(status[i]);
          if (status[i].id == 3) $scope.estatus.push(status[i]);
          if (status[i].id == 4) $scope.estatus.push(status[i]);
          if (status[i].id == 7) $scope.estatus.push(status[i]);
        }
      }
      if ($scope.ticket.estatus_id == 3) {
        for (i = 0; i < status.length; i++) {
          if (status[i].id == 3) $scope.estatus.push(status[i]);
          if (status[i].id == 4) $scope.estatus.push(status[i]);
          if (status[i].id == 7) $scope.estatus.push(status[i]);
        }
      }
      if ($scope.ticket.estatus_id == 4) {
        for (i = 0; i < status.length; i++) {
          if (status[i].id == 4) $scope.estatus.push(status[i]);
          if (status[i].id == 3) $scope.estatus.push(status[i]);
          if (status[i].id == 5) $scope.estatus.push(status[i]);
          if (status[i].id == 7) $scope.estatus.push(status[i]);
        }
      }
      if ($scope.ticket.estatus_id == 5) {
        for (i = 0; i < status.length; i++) {
          if (status[i].id == 5) $scope.estatus.push(status[i]);
        }
      }
      if ($scope.ticket.estatus_id == 6) {
        for (i = 0; i < status.length; i++) {
          if (status[i].id == 6) $scope.estatus.push(status[i]);
        }
      }
      if ($scope.ticket.estatus_id == 7) {
        for (i = 0; i < status.length; i++) {
          if (status[i].id == 7) $scope.estatus.push(status[i]);
        }
      }
      if ($scope.ticket.estatus_id == 8) {
        for (i = 0; i < status.length; i++) {
          if (status[i].id == 8) $scope.estatus.push(status[i]);
        }
      }
      $scope.selectEspecialista();
      $scope.selectServicio();
      $("#editor .ql-editor").html($scope.ticket.descripcion);
      $("#editor-solucion .ql-editor").html($scope.ticket.solucion);
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

  $scope.guardarSolucion = function (ticket) {
    $scope.ticket.solucion = quill2.container.firstChild.innerHTML;
    $scope.ticket.estatus_id = document.getElementById("estatus").value;
    $scope.ticket.especialista_id =
      document.getElementById("especialista").value;
    $scope.ticket.proyecto_id = document.getElementById("proyecto").value;
    $scope.ticket.prioridad_id = document.getElementById("prioridad").value;
    $scope.ticket.ticket_tipo_id = document.getElementById("tipo").value;
    $scope.ticket.servicio_id = document.getElementById("servicio").value;
    console.log(ticket);

    $http({
      url: "ver-ticket",
      method: "PUT",
      headers: {
        "Content-Type": "application/json",
      },
      data: ticket,
    }).then(
      function successCallback(response) {
        $scope.estatus = new Array();
        $scope.ticket = response.data.ticket;

        var status = response.data.estatus;

        if ($scope.ticket.estatus_id == 1) {
          for (i = 0; i < status.length; i++) {
            if (status[i].id == 1) $scope.estatus.push(status[i]);
            if (status[i].id == 2) $scope.estatus.push(status[i]);
            if (status[i].id == 7) $scope.estatus.push(status[i]);
          }
        }
        if ($scope.ticket.estatus_id == 2) {
          for (i = 0; i < status.length; i++) {
            if (status[i].id == 2) $scope.estatus.push(status[i]);
            if (status[i].id == 3) $scope.estatus.push(status[i]);
            if (status[i].id == 4) $scope.estatus.push(status[i]);
            if (status[i].id == 7) $scope.estatus.push(status[i]);
          }
        }
        if ($scope.ticket.estatus_id == 3) {
          for (i = 0; i < status.length; i++) {
            if (status[i].id == 3) $scope.estatus.push(status[i]);
            if (status[i].id == 4) $scope.estatus.push(status[i]);
            if (status[i].id == 7) $scope.estatus.push(status[i]);
          }
        }
        if ($scope.ticket.estatus_id == 4) {
          for (i = 0; i < status.length; i++) {
            if (status[i].id == 4) $scope.estatus.push(status[i]);
            if (status[i].id == 3) $scope.estatus.push(status[i]);
            if (status[i].id == 5) $scope.estatus.push(status[i]);
            if (status[i].id == 7) $scope.estatus.push(status[i]);
          }
        }
        if ($scope.ticket.estatus_id == 5) {
          for (i = 0; i < status.length; i++) {
            if (status[i].id == 5) $scope.estatus.push(status[i]);
          }
        }
        if ($scope.ticket.estatus_id == 6) {
          for (i = 0; i < status.length; i++) {
            if (status[i].id == 6) $scope.estatus.push(status[i]);
          }
        }
        if ($scope.ticket.estatus_id == 7) {
          for (i = 0; i < status.length; i++) {
            if (status[i].id == 7) $scope.estatus.push(status[i]);
          }
        }
        if ($scope.ticket.estatus_id == 8) {
          for (i = 0; i < status.length; i++) {
            if (status[i].id == 8) $scope.estatus.push(status[i]);
          }
        }
        $("#editor .ql-editor").html($scope.ticket.descripcion);
        $("#editor-solucion .ql-editor").html($scope.ticket.solucion);
        //console.log('put bien: ', response);
        swal(
          titulos.gestion_tickets,
          response.data.message,
          tiposDeMensaje.exito
        );
      },
      function errorCallback(response) {
        console.log("Error: ", response);
        swal(titulos.gestion_tickets, response.data.message, "error");
      }
    );
  };

  $scope.selectEspecialista = function () {
    var value = $("#grupo option:selected").val();
    if (typeof value === "undefined") {
      value = $scope.ticket.especialista.mi_perfil.id;
    }
    $scope.responsables = [];
    for (let i in $scope.especialistas) {
      if ($scope.especialistas[i].perfil_id == value) {
        $scope.responsables.push($scope.especialistas[i]);
      }
    }
  };

  $scope.selectServicio = function () {
    var value = $("#categoria option:selected").val();
    if (typeof value === "undefined") {
      value = $scope.ticket.servicio.categoria.id;
    }
    $scope.services = [];
    for (let i in $scope.servicios) {
      if ($scope.servicios[i].categoria_id == value) {
        $scope.services.push($scope.servicios[i]);
      }
    }
  };
});
