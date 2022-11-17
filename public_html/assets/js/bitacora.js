var app = angular.module("bitacora", ["angularUtils.directives.dirPagination"]);

app.controller("bitacora", function ($interval, $scope, $http, $window) {
    $scope.currentPage = 1;
    $scope.pageSize = 9;
    $scope.bitacoras = [];
    // $scope.bitacoras = JSON.parse(bitacoras.replace(/&quot;/g, '"'));
    var interval;

    $scope.obtenerBitacora = function () {
        $http({
          url: 'bitacora/consulta-bitacora',
          method: 'GET',
          headers: {
            'Content-Type': 'application/json',
            Accept: 'application/json',
          },
        }).then(
          function successCallback(response) {
            console.log("salio bien: ", response);
            $scope.bitacoras = response.data.bitacoras;
            
          },
          function errorCallback(response) {
            console.log('hubo error: ', response);
            swal(
                titulos.bitacora,
                response.data.message,
                'error'
            );
          },
        );
    }

    // starts the interval
    $scope.start = function () {
        // stops any running interval to avoid two intervals running at the same time
        $scope.stop();
        // store the interval promise
        interval = $interval(updateBitacora, 1000);
        $('.update-bitacora').removeClass('btn-success').addClass('btn-danger');
    };

    // stops the interval
    $scope.stop = function () {
        $scope.detenido = $interval.cancel(interval);
        //console.log($scope.detenido);
        $('.update-bitacora').removeClass('btn-danger').addClass('btn-success');
    };


    // start interval
    $scope.start();

    function updateBitacora() {
        //console.log("function works");
        $scope.actualizar_bitacora = $http({
            url: "bitacora/actualizar",
            method: "GET",
        }).then(
            function successCallback(response) {
                console.log(response);
                if (response.data.code == 200) {
                    $scope.bitacoras = response.data.bitacoras;
                } else {
                    swal(
                        titulos.bitacora,
                        response.data.message,
                        response.data.status
                    );
                }
            },
            function errorCallback(response) {
                console.log(response);
                if(response.status === 401) {
                    swal(
                        titulos.bitacora,
                        'Su sesión ha vencido.',
                        'error'
                    );
                    $window.location.reload();
                } else {
                    swal(
                        titulos.bitacora,
                        response.data.message,
                        'error'
                    );    
                }
            }
        );
    }

    $scope.bitacoraDetalle = function(bitacora){
        //console.log(bitacora);
        $('#bitacora-modalLabel').html(bitacora.descripcion);
        $('#bitacora_trace').html(bitacora.trace);
        if(bitacora.documento != 'S/D'){
            $('#bitacora_documento').html(`Documento: <span class='font-weight-bold'>${bitacora.documento}</span>`);
        } else{
            $('#bitacora_documento').html('');
        }
        $('#bitacora-modal').modal('show');
    }

    $scope.modulos = function (id) {
        $('#modulo-'+id).trigger('submit');
    };
    
});
