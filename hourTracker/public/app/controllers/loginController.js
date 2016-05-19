/**
 * Created by suba on 5/16/2016.
 */
(function(){
    "use strict";

    angular.module("hourTracker")
        .controller("loginController",
        ['$scope', '$http', '$state', LoginController]);

    function LoginController($scope, $http, $state){
        var vm = this;
        vm.loginError = false;

        //Check if user is already logged in
        $http.get('api/v1/login')
            .then(
                //successCallback
                function(response) {
                    vm.user = response.data;
                    $state.go('hourTracker');
                },
                //errorCallback
                function (response) {
                    console.log(response.data.message);
                });

        vm.login = function(){
            $http({
                method: 'POST',
                url: 'api/v1/login',
                data: $.param(vm.user),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(
                //successCallback
                function(response) {
                    //Send logged in user to hour tracker view
                    $state.go('hourTracker');
            },
                //errorCallback
                function(response) {
                    vm.loginError = true;
            });
        }
    }
})();