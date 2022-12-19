var app = angular.module('clientes', [ 'angularUtils.directives.dirPagination' ]);

app.controller( 'clientes', function ($scope, $http, $httpParamSerializerJQLike) {
  $scope.currentPage = 1;
  $scope.pageSize = 11;

  $scope.dato = {};
  $scope.datos = [];
  $scope.perfiles = [];
  $scope.servicios = [];
  $scope.createForm = {};
  
  $http({
      url: 'clientes/getclientes',
      method: 'GET',
      headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
      },
  }).then(
      function successCallback(response) {
          console.log(response);
          $scope.datos = response.data.datos;
          $scope.perfiles = response.data.perfiles;
          $scope.servicios = response.data.servicios;
      },
      function errorCallback(response) {
          console.log(response);
          swal(
              'Mensaje del Sistema',
              response.data.message,
              tiposDeMensaje.error
          );
      }
  );

  $scope.create = function () {

      $http({
          url: 'clientes/create',
          method: 'GET',
          headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json',
          },
      }).then(
          function successCallback(response) {
              console.log(response);
              $('#createForm').trigger('reset');
              // Remover valores de todos los selectpicker y refresh
              $('.selectpicker').selectpicker('deselectAll');
              $('.selectpicker').selectpicker('refresh');
              $('#agregarModal').modal('show');
          },
          function errorCallback(response) {
              console.log(response);
              swal(
                  'Mensaje del Sistema',
                  response.data.message,
                  response.data.status
              );
          }
      );
  }

  $scope.store = function () {

    let servicios = [];

    $.each($('#servicios_asig option:selected'), function () {
      console.log($(this).val());
      let id = $(this).val();
      let servicio = new Object();
      servicio.id = id;
      servicios.push(servicio);
    })
    $scope.createForm.servicios_asig = servicios;

      $http({
          url: 'clientes',
          method: 'POST',
          headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json',
          },
          data: $scope.createForm
      }).then(
          function successCallback(response) {
              console.log(response);
              $scope.datos = [...$scope.datos, response.data.dato];
              $('#createForm').trigger('reset');
              $('#agregarModal').modal('hide');
              swal(
                  'Mensaje del Sistema',
                  response.data.message,
                  response.data.status
              );
          },
          function errorCallback(response) {
              console.log(response);
              //$('#agregarModal').modal('hide');
              
              if (response.status === 422) {
                  let mensaje = '';
                  for (let i in response.data.errors) {
                      mensaje += response.data.errors[i] + '\n';
                  }
                  swal('Mensaje del Sistema', mensaje, 'error');
              } else {
                  swal(
                      'Mensaje del Sistema',
                      response.data.message,
                      response.data.status
                  );
              }
              
          }
      );
  }

  $scope.edit = function (dato) {
      console.log('dato escogido: ', dato);
      $scope.dato = dato;
      $('#edit-id').val(dato.id);
      
      $http({
          url: 'clientes/edit',
          method: 'GET',
          headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json',
          },
      }).then(
          function successCallback(response) {
              console.log(response);
              
              // Remover valores de todos los selectpicker y refresh
              $('.selectpicker').selectpicker('deselectAll');
              $('.selectpicker').selectpicker('refresh');

              let seleccion = [];
              for (var [key, value] of Object.entries($scope.dato.servicios)) {
                seleccion.push(value.id);
              }
              $('#servicios_asig_edit').selectpicker('val', seleccion);

              $('#editarModal').modal('show');
          },
          function errorCallback(response) {
              console.log(response);
              swal(
                  'Mensaje del Sistema',
                  response.data.message,
                  response.data.status
              );
          }
      );
  }

  $scope.update = function () {
    let dato_editado = $scope.dato;

    let servicios = [];

    $.each($('#servicios_asig_edit option:selected'), function () {
        console.log($(this).val());
        let id = $(this).val();
        let servicio = new Object();
        servicio.id = id;
        servicios.push(servicio);
    })

    dato_editado.servicios_asig_edit = servicios;

      $http({
          url: `clientes`,
          method: 'PUT',
          data: dato_editado,
          headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json',
          },
      }).then(
          function successCallback(response) {
                console.log('response: ', response);
                $scope.dato = response.data.dato;
                $scope.datos = $scope.datos.map(dato => (dato.id == response.data.dato.id) ? dato = response.data.dato : dato);
                $('#editarModal').modal('hide');

                swal(
                    'Mensaje del Sistema',
                    response.data.message,
                    response.data.status
                );
          },
          function errorCallback(response) {
              console.log(response);
              if (response.status === 422) {
                  let mensaje = '';
                  for (let i in response.data.errors) {
                      mensaje += response.data.errors[i] + '\n';
                  }
                  swal('Mensaje del Sistema', mensaje, 'error');
              } else {
                  swal(
                      'Mensaje del Sistema',
                      response.data.message,
                      response.data.status
                  );
              }
          }
      );
  }

  $scope.confirmarEliminar = function (dato) {
    console.log(dato);
      $scope.dato = dato;
      $('#nombre-dato').html(dato.nombre);
      $('#eliminarModal').modal('show');
  }

  $scope.delete = function () {
      console.log('dato: ', $scope.dato);

      $http({
          url: `clientes/${$scope.dato.id}`,
          method: 'DELETE',
          headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json',
          },
      }).then(
          function successCallback(response) {
              console.log(response);
              $scope.datos = $scope.datos.filter(dato => dato.id !== $scope.dato.id);
              $('#eliminarModal').modal('hide');
              swal(
                  'Mensaje del Sistema',
                  response.data.message,
                  response.data.status
              );
          },
          function errorCallback(response) {
              console.log(response);
              swal(
                  'Mensaje del Sistema',
                  response.data.message,
                  response.data.status
              );
          }
      );
      
  }
});

app.filter('listarServicios', function() {
    return function(servicios) {
        let lista = "";
        servicios.forEach(servicio => {
            lista += servicio.nombre + ", "
        });
        return lista;
    }
  });