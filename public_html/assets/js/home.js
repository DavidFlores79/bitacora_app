var app = angular.module("home", []);

app.controller("home", function ($scope, $http, $window) {
  $scope.modulos = function (modulo) {
    console.log(modulo);
    $("#modulo-" + modulo).trigger("submit");
  };

  $http({
    url: "get-profile-code",
    method: "GET",
    headers: {
      "Content-Type": "application/json",
      Accept: "application/json",
    },
  }).then(
    function successCallback(response) {
      console.log(response);

      $window.OneSignal = $window.OneSignal || [];
      OneSignal.push(function () {
        OneSignal.init({
          appId: "471d2d5f-4105-476e-a74d-68bf9277053e",
        });
    
        OneSignal.sendTag("perfil", response.data, function (tagsSent) {
          console.log(`Perfil ${response.data}`);
        });
    
        OneSignal.getUserId(function (userId) {
          console.log(userId);
        });
      });
    },
    function errorCallback(response) {
      console.log(response);
      swal("Mensaje del Sistema", response.data.message, tiposDeMensaje.error);
    }
  );

});
