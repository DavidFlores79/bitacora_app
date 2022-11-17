var app = angular.module("home", []);

app.controller("home", function ($scope, $http, $window) {
    $scope.modulos = function (modulo) {
        console.log(modulo);
        $("#modulo-" + modulo).trigger("submit");
      };
});
