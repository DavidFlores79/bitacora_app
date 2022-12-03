var app = angular.module("administradores", [
  "angularUtils.directives.dirPagination",
]);

app.controller(
  "administradores",
  function ($scope, $http, $httpParamSerializerJQLike, $window) {
    $scope.currentPage = 1;
    $scope.pageSize = 11;

    $scope.dato = {};
    $scope.datos = [];
    $scope.perfiles = [];
    $scope.createForm = {};


    $window.OneSignal = $window.OneSignal || [];
    OneSignal.push(function() {
        OneSignal.init({
            appId: "471d2d5f-4105-476e-a74d-68bf9277053e",
        });

        OneSignal.sendTag("perfil", "admin", function(tagsSent) {
            console.log('Perfil admin');
        });


        OneSignal.getUserId(function(userId) {
            console.log(userId);
        });
    });


    $http({
      url: "administradores/getadmin",
      method: "GET",
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
      },
    }).then(
      function successCallback(response) {
        console.log(response);
        $scope.datos = response.data.datos;
        $scope.perfiles = response.data.perfiles;
        console.log($scope.datos);
      },
      function errorCallback(response) {
        console.log(response);
        swal(
          "Mensaje del Sistema",
          response.data.message,
          tiposDeMensaje.error
        );
      }
    );

    $scope.create = function () {
      $http({
        url: "administradores/create",
        method: "GET",
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
        },
      }).then(
        function successCallback(response) {
          console.log(response);
          $("#createForm").trigger("reset");
          $("#agregarModal").modal("show");
        },
        function errorCallback(response) {
          console.log(response);
          swal(
            "Mensaje del Sistema",
            response.data.message,
            response.data.status
          );
        }
      );
    };

    $scope.store = function () {
      $http({
        url: "empleados",
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
        },
        data: $scope.createForm,
      }).then(
        function successCallback(response) {
          console.log(response);
          $scope.datos = [...$scope.datos, response.data.dato];
          $("#createForm").trigger("reset");
          $("#agregarModal").modal("hide");
          swal(
            "Mensaje del Sistema",
            response.data.message,
            response.data.status
          );
        },
        function errorCallback(response) {
          console.log(response);
          //$('#agregarModal').modal('hide');

          if (response.status === 422) {
            let mensaje = "";
            for (let i in response.data.errors) {
              mensaje += response.data.errors[i] + "\n";
            }
            swal("Mensaje del Sistema", mensaje, "error");
          } else {
            swal(
              "Mensaje del Sistema",
              response.data.message,
              response.data.status
            );
          }
        }
      );
    };

    $scope.edit = function (dato) {
      console.log("cat: ", dato);
      $scope.dato = dato;
      $('#edit-id').val(dato.id);

      $http({
        url: "administradores/edit",
        method: "GET",
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
        },
      }).then(
        function successCallback(response) {
          console.log(response);
          $("#editarModal").modal("show");
        },
        function errorCallback(response) {
          console.log(response);
          swal(
            "Mensaje del Sistema",
            response.data.message,
            response.data.status
          );
        }
      );
    };

    $scope.update = function () {
        let dato_editado = $scope.dato;

      $http({
        url: `empleados`,
        method: "PUT",
        data: dato_editado,
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
        },
      }).then(
        function successCallback(response) {
          console.log("response: ", response);
          $scope.dato = response.data.dato;
          $scope.datos = $scope.datos.map((dato) =>
            dato.id == response.data.dato.id
              ? (dato = response.data.dato)
              : dato
          );
          $("#editarModal").modal("hide");
          swal(
            "Mensaje del Sistema",
            response.data.message,
            response.data.status
          );
        },
        function errorCallback(response) {
          console.log(response);
          if (response.status === 422) {
            let mensaje = "";
            for (let i in response.data.errors) {
              mensaje += response.data.errors[i] + "\n";
            }
            swal("Mensaje del Sistema", mensaje, "error");
          } else {
            swal(
              "Mensaje del Sistema",
              response.data.message,
              response.data.status
            );
          }
        }
      );
    };

    $scope.confirmarEliminar = function (dato) {
      console.log(dato);
      $scope.dato = dato;
      $("#nombre-dato").html(dato.nombre);
      $("#eliminarModal").modal("show");
    };

    $scope.delete = function () {
      console.log("dato: ", $scope.dato);

      $http({
        url: `administradores/${$scope.dato.id}`,
        method: "DELETE",
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
        },
      }).then(
        function successCallback(response) {
          console.log(response);
          $scope.datos = $scope.datos.filter(
            (dato) => dato.id !== $scope.dato.id
          );
          $("#eliminarModal").modal("hide");
          swal(
            "Mensaje del Sistema",
            response.data.message,
            response.data.status
          );
        },
        function errorCallback(response) {
          console.log(response);
          swal(
            "Mensaje del Sistema",
            response.data.message,
            response.data.status
          );
        }
      );
    };
  }
);
