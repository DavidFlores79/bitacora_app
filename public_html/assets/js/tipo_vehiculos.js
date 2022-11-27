var app = angular.module('tipo_vehiculos', [ 'angularUtils.directives.dirPagination' ]);

app.controller( 'tipo_vehiculos', function ($scope, $http, $httpParamSerializerJQLike) {
  $scope.currentPage = 1;
  $scope.pageSize = 11;

  $scope.dato = {};
  $scope.datos = [];
  $scope.createForm = {};
  
  $http({
      url: 'tipo-vehiculos/getinfo',
      method: 'GET',
      headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
      },
  }).then(
      function successCallback(response) {
          console.log(response);
          $scope.datos = response.data.datos;
          console.log($scope.datos);
      },
      function errorCallback(response) {
          console.log(response);
          swal(
              configuraciones.titulo,
              response.data.message,
              tiposDeMensaje.error
          );
      }
  );

  $scope.create = function () {

      $http({
          url: 'tipo-vehiculos/create',
          method: 'GET',
          headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json',
          },
      }).then(
          function successCallback(response) {
              console.log(response);
              $('#createForm').trigger('reset');
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

      $http({
          url: 'tipo-vehiculos',
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
      console.log('cat: ', dato);
      $('#edit-nombre').val(dato.nombre);
      $('#edit-id').val(dato.id);
      
      $http({
          url: 'tipo-vehiculos/edit',
          method: 'GET',
          headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json',
          },
      }).then(
          function successCallback(response) {
              console.log(response);
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
      let dato_editado = {
          id: $('#edit-id').val(),
          nombre: $('#edit-nombre').val(),
      };

      $http({
          url: `tipo-vehiculos`,
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
          url: `tipo-vehiculos/${$scope.dato.id}`,
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


})