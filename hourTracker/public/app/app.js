/**
 * Created by suba on 5/16/2016.
 */
(function(){
    "use strict";

    var app = angular.module("hourTracker",[
        "ui.router",
        "ui.bootstrap"
    ]);

    app.config([
        "$stateProvider", "$urlRouterProvider",
        function ($stateProvider, $urlRouterProvider) {
            $urlRouterProvider.otherwise("/");
            $stateProvider
                .state("login",{
                    url: "/",
                    templateUrl: "app/views/loginView.html",
                    controller: "loginController as vm"
                })
                .state("hourTracker",{
                    url: "/hourTracker",
                    templateUrl: "app/views/hourTrackerView.html",
                    controller: 'hourTrackerController as vm'
                });
        }
    ]);
})();