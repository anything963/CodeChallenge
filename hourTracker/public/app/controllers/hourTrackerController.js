/**
 * Created by suba on 5/17/2016.
 */

(function(){
    "use strict";

    angular.module("hourTracker")
        .controller("hourTrackerController",
            ['$scope', '$http', '$state', HourTrackerController]);

    function HourTrackerController($scope, $http, $state){
        var vm = this;
        vm.displayMaxHoursRuleError = false;
        vm.displayWeekendRuleError = false;
        vm.displayRangeError = false;


        //Get hours if previously entered
        $http.get('api/v1/hour')
            .then(
                //successCallback
                function(response) {
                    if (response.data.length === 0) {
                        vm.hours = {
                            sunday: 0,
                            monday: 0,
                            tuesday: 0,
                            wednesday: 0,
                            thursday: 0,
                            friday: 0,
                            saturday: 0
                        };
                    } else {
                        vm.hours = response.data[0];
                    }
                },
                //errorCallback
                function (response) {
                    console.log(response);
                });

        vm.submit = function(){
            if (verifyTotalHoursAndRange()){
                if(verifyWeekendRule()){
                    //POST hours
                    $http({
                        method: 'POST',
                        url: 'api/v1/hour',
                        data: $.param(vm.hours),
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                    }).then(
                        //successCallback
                        function(response) {
                            toastr.success("Hours submitted.");
                        },
                        //errorCallback
                        function(response) {
                            console.log(response);
                            toastr.error('Submission failed. Try Again.', 'Error');
                        });
                }
            }

        }

        vm.logout = function(){
            $http.get('api/v1/logout')
                .then(
                    //successCallback - send to login page
                    function(response) {
                        $state.go('login');
                    },
                    //errorCallback
                    function (response) {
                        console.log(response);
                    });
        }

        /**
         * To verify a user cannot work more than 40 hours in a week
         * @returns {boolean}
         */
        function verifyTotalHoursAndRange(){
            var MAX_HOURS_ALLOWED = 40;
            var totalHours = (vm.hours.sunday || 0)
                            + (vm.hours.monday || 0)
                            + (vm.hours.tuesday || 0)
                            + (vm.hours.wednesday || 0)
                            + (vm.hours.thursday || 0)
                            + (vm.hours.friday || 0)
                            + (vm.hours.saturday || 0);

            //total hours is NaN if range is not followed
            if( (vm.hours.sunday < 0 || vm.hours.sunday > 10)
                    || (vm.hours.monday < 0 || vm.hours.monday > 10)
                    || (vm.hours.tuesday < 0 || vm.hours.tuesday > 10)
                    || (vm.hours.wednesday < 0 || vm.hours.wednesday > 10)
                    || (vm.hours.thursday < 0 || vm.hours.thursday > 10)
                    || (vm.hours.friday < 0 || vm.hours.friday > 10)
                    || (vm.hours.saturday < 0 || vm.hours.saturday > 10)
                ){
                vm.displayRangeError = true;
                return false;
            } else {
                vm.displayRangeError = false;

            }

            //validate total hours
            if (totalHours <= MAX_HOURS_ALLOWED){
                vm.displayMaxHoursRuleError = false;
                return true;
            } else {
                vm.displayMaxHoursRuleError = true;
                return false;
            }
        }

        /**
         * To verify if a user works Saturday and Sunday, they must not work Monday
         * @returns {boolean}
         */
        function verifyWeekendRule(){
            if (vm.hours.saturday > 0 && vm.hours.sunday > 0) {
                if (vm.hours.monday > 0) {
                    vm.displayWeekendRuleError = true;
                    return false;
                } else {
                    vm.displayWeekendRuleError = false;
                    return true;
                }
            } else {
                vm.displayWeekendRuleError = false;
                return true;
            }
        }
    }
})();