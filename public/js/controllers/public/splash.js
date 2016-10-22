(function () {

    // @ngInject
    function SplashCtrl($http, Station, Contact, Alert, GOOGLE_MAPS_API){

        var vm = this;
        vm.defaultUser = {}
        vm.currentUser = angular.copy(vm.defaultUser);
        vm.googleMapsUrl = GOOGLE_MAPS_API.url + '?key=' + GOOGLE_MAPS_API.key;

        Station.query().then(function(response) {
            vm.stations = response;
        });

        vm.contact = function() {
            Contact.post(vm.currentUser).then(function(response){
                vm.resetContactForm();
            });
            return false;
        };

        vm.resetContactForm = function() {
            vm.currentUser = angular.copy(vm.defaultUser);
            vm.contactForm.$setPristine();
            vm.contactForm.$setUntouched();
        };

    }

    angular
        .module('app')
        .controller('SplashCtrl', SplashCtrl);

})();










