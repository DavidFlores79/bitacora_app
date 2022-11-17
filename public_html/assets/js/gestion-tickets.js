var app = angular.module("gestiontickets", [
  "angularUtils.directives.dirPagination",
]);

app.controller(
  "gestiontickets",
  function ($scope, $http, $httpParamSerializerJQLike) {
    $scope.currentPage = 1;
    $scope.pageSize = 9;

    $http({
      url: "gestion-tickets/getTickets",
      method: "GET",
      headers: {
        "Content-Type": "application/json",
      },
    }).then(
      function successCallback(response) {
        //console.log(response);
        $scope.tickets = response.data.tickets;
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

    $scope.modalNuevo = function () {
      $http({
        url: "gestion-tickets/create",
        method: "GET",
        headers: {
          "Content-Type": "application/json",
        },
      }).then(
        function successCallback(response) {
          $("#new-ticket").trigger("reset");
          $("#mdl_add_tickets").modal("show");
          $scope.selectEspecialista();
          $scope.selectServicio();
        },
        function errorCallback(response) {
          console.log("Error: ", response);
          swal(
            titulos.gestion_tickets,
            response.data.message,
            tiposDeMensaje.error
          );
        }
      );
    };

    $scope.submitAgregar = function () {

      const $archivos = document.querySelector("#avatar");
      let archivos = $archivos.files;

      // if (archivos.length == 0) {
      //   swal("monitorGV.titulo", "mensajes.PdfNoCargado", "warning");
      //   return;
      // }
      var nombre_archivo;
      angular.forEach(archivos, function (archivo) {
        nombre_archivo = archivo.name;
        console.log(archivo);
      });

      var formStore = $("#new-ticket").serializeJSON();
      formStore.archivo = nombre_archivo;
      formStore.descripcion = quill.container.firstChild.innerHTML;
      console.log(formStore);

      $http({
        url: "gestion-tickets",
        method: "POST",
        data: $httpParamSerializerJQLike(formStore),
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
          Accept: "application/json",
        },
      }).then(
        function successCallback(response) {
          //console.log(response);
          $scope.tickets = response.data.tickets;
          $("#mdl_add_tickets").modal("hide");
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

    $scope.eliminar = function (deleteId) {
      swal({
        title: "¿Seguro quieres eliminar este ticket?",
        text: "Una vez eliminado, ya no podrás recuperarlo.",
        icon: "warning",
        buttons: ["Cancelar", "Eliminar"],
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {
          $http({
            url: "gestion-tickets/" + JSON.stringify(deleteId),
            method: "DELETE",
            headers: {
              "Content-Type": "application/json",
            },
            data: "",
          }).then(
            function successCallback(response) {
              if (response.data.status == "success") {
                let result = response.data;
                $scope.tickets = response.data.tickets;
                swal(
                  "Ticket " + result.name,
                  result.message,
                  tiposDeMensaje.exito
                );
              } else {
                swal(
                  titulos.gestion_tickets,
                  response.data.message,
                  tiposDeMensaje.error
                );
              }
            },
            function errorCallback(response) {
              console.log("error", response);
              swal(
                titulos.gestion_tickets,
                response.data.message,
                tiposDeMensaje.error
              );
            }
          );
        }
      });
    };

    $scope.selectEspecialista = function () {
      var value = $("#grupox option:selected").val();
      $scope.responsables = [];
      for (let i in $scope.especialistas) {
        if ($scope.especialistas[i].perfil_id == value) {
          $scope.responsables.push($scope.especialistas[i]);
        }
      }
    };

    $scope.selectServicio = function () {
      var value = $("#categoriax option:selected").val();
      $scope.services = [];
      for (let i in $scope.servicios) {
        if ($scope.servicios[i].categoria_id == value) {
          $scope.services.push($scope.servicios[i]);
        }
      }
    };
  }
);
