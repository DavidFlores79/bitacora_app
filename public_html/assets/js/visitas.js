var app = angular.module("visitas", ["angularUtils.directives.dirPagination"]);

app.controller("visitas", function ($scope, $http, $httpParamSerializerJQLike) {
  $scope.currentPage = 1;
  $scope.pageSize = 5;
  $scope.user = {
    name: "",
    apellido: "",
    email: "",
    telefono: "",
    password: "",
    perfil: "",
    estatus: true,
  };

  $http({
    url: "visitas/getVisitas",
    method: "GET",
    headers: {
      "Content-Type": "application/json",
      Accept: "application/json",
    },
  }).then(
    function successCallback(response) {
      console.log("salio bien: ", response);
      $scope.datos = response.data.datos;
    },
    function errorCallback(response) {
      console.log("hubo error: ", response);
      swal("titulo", "mensaje", "error");
    }
  );
  $scope.create = () => {
    $("#mdl_add_users").modal("show");
  };

  $scope.show = (dato) => {
    console.log(dato);
    $scope.dato = dato;
    $("#detallesModal").modal("show");
  }

  $scope.create = function () {
    $http({
      url: "visitas/create",
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
      url: "visitas",
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
    //   $('#edit-nombre').val(dato.nombre);
    $("#edit-id").val(dato.id);

    $http({
      url: "visitas/edit",
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
      url: `visitas`,
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
          dato.id == response.data.dato.id ? (dato = response.data.dato) : dato
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
      url: `visitas/${$scope.dato.id}`,
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

  $scope.fixDate = function (date) {
    return new Date(date);
  };
});

// app.filter('tipoVehiculo', function($sce) {
//   return function(input) {
//       return (input.includes('Mot')) ? "<i class='fas fa-motorcycle'></i>" : 'Otro';
//   }
// });
