var app = angular.module("visitas", ["angularUtils.directives.dirPagination"]);

app.controller("visitas", function ($scope, $http, $httpParamSerializerJQLike) {
  $scope.currentPage = 1;
  $scope.pageSize = 5;
  $scope.servicios = [];
  $scope.misServicios = [];
  $scope.tipos_vehiculo = [];
  $scope.imagen_placas = '';
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
      $scope.servicios = response.data.servicios;
      $scope.misServicios = response.data.mis_servicios;
      $scope.tipos_vehiculo = response.data.tipos_vehiculo;
      $scope.constarSalidas();
    },
    function errorCallback(response) {
      console.log("hubo error: ", response);
      swal("titulo", "mensaje", "error");
    }
  );
  // $scope.create = () => {
  //   $("#mdl_add_users").modal("show");
  // };

  $scope.show = (dato) => {
    console.log(dato);
    $http({
      url: `visitas/${dato.id}`,
      method: "GET",
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
      },
    }).then(
      function successCallback(response) {
        console.log(response);
        $scope.dato = response.data.dato;
        $("#detallesModal").modal("show");
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

  $('#agregarModal').on('hidden.bs.modal', function (e) {
    //resetear los inputs de imagenes
    $("#imagen_placas").val(null);
    $("#imagen_identificacion").val(null);
    $("#imagen_placas_preview img:last-child").remove()
    $("#imagen_identificacion_preview img:last-child").remove()
  })

  $scope.store = function () {

    $scope.createForm.imagen_placas = $scope.imagen_placas;
    $scope.createForm.imagen_identificacion = $scope.imagen_identificacion;

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
        $scope.constarSalidas();
        $scope.datos = [response.data.dato, ...$scope.datos];
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

  $scope.confirmarSalida = function (dato) {
    console.log(dato);
    $scope.dato = dato;
    $("#salidaModal").modal("show");
  };

  $scope.registrarSalida = function (dato) {
    console.log(dato);
    $scope.dato = dato;

    $http({
      url: `visitas/${dato.id}`,
      method: "PATCH",
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
      },
    }).then(
      function successCallback(response) {
        console.log(response);
        $scope.constarSalidas();
        $scope.datos = $scope.datos.map((dato) =>
          dato.id == response.data.dato.id ? (dato = response.data.dato) : dato
        );
        $("#salidaModal").modal("hide");
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

  $scope.confirmarEliminar = function (dato) {
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
        $scope.constarSalidas();
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

  $scope.modalIncidencia = function (dato) {
    $scope.dato = dato ?? null;
    $http({
      url: "incidencias/create",
      method: "GET",
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
      },
    }).then(
      function successCallback(response) {
        console.log(response);
        $("#createIncidencia").trigger("reset");
        $("#detallesModal").modal("hide");
        $("#incidenciaModal").modal("show");
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
  }

  $scope.registrarIncidencia = function () {
    console.log('incidencia');
    if($scope.dato) $scope.createIncidencia.visita_id = $scope.dato.id;
    $http({
      url: "incidencias",
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
      },
      data: $scope.createIncidencia,
    }).then(
      function successCallback(response) {
        console.log(response);
        if($scope.dato) {
          $scope.dato.incidencias = [response.data.dato, ...$scope.dato.incidencias];
        }
        $("#createIncidencia").trigger("reset");
        $("#incidenciaModal").modal("hide");
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
  }

  $scope.fixDate = function (date) {
    if(date) {
      return new Date(date)
    } else {
      return null
    };
  };

  $scope.constarSalidas = () => {
    $('#cuantasSalidas').html()
    setTimeout(() => {
      let i = 0;
      $scope.datosFiltrados;
      $scope.datosFiltrados.map( registro => {
        if(registro.fecha_salida == '' || registro.fecha_salida == null) {
          i++;
        }
      })
      $('#cuantasSalidas').html(i)
    }, 2000);
  };

  $scope.uploadFilePlacas = function(event){
    const filesSelected = document.getElementById('imagen_placas').files;
    if (filesSelected.length > 0) {
      const fileToLoad = filesSelected[0];

      const fileReader = new FileReader();

      fileReader.onload = function(fileLoadedEvent) {
        const srcData = fileLoadedEvent.target.result; // <--- data: base64

        const newImage = document.createElement('img');
        newImage.style.height = '60px';
        newImage.src = srcData;

        document.getElementById('imagen_placas_preview').innerHTML = newImage.outerHTML;
        $scope.imagen_placas = srcData;
      }
      fileReader.readAsDataURL(fileToLoad);
    }
  };

  $scope.uploadFileId = function(event){
    const filesSelected = document.getElementById('imagen_identificacion').files;
    if (filesSelected.length > 0) {
      const fileToLoad = filesSelected[0];

      const fileReader = new FileReader();

      fileReader.onload = function(fileLoadedEvent) {
        const srcData = fileLoadedEvent.target.result; // <--- data: base64

        const newImage = document.createElement('img');
        newImage.style.height = '60px';
        newImage.src = srcData;

        document.getElementById('imagen_identificacion_preview').innerHTML = newImage.outerHTML;
        $scope.imagen_identificacion = srcData;
      }
      fileReader.readAsDataURL(fileToLoad);
    }
  };
  
});

app.directive('customOnChange', function() {
  return {
    restrict: 'A',
    link: function (scope, element, attrs) {
      var onChangeHandler = scope.$eval(attrs.customOnChange);
      element.on('change', onChangeHandler);
      element.on('$destroy', function() {
        element.off();
      });

    }
  };
});

// app.filter('tipoVehiculo', function($sce) {
//   return function(input) {
//       return (input.includes('Mot')) ? "<i class='fas fa-motorcycle'></i>" : 'Otro';
//   }
// });
