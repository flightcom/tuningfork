(function () {

    // @ngInject
    function SplashCtrl($http, Station, Contact, Alert, GOOGLE_MAPS_API){

        var vm = this;
        vm.defaultUser = {}
        vm.currentUser = angular.copy(vm.defaultUser);
        vm.googleMapsUrl = GOOGLE_MAPS_API.url + '?key=' + GOOGLE_MAPS_API.key;

        Station.query().then(function(response) {
            console.log(response);
            vm.stations = response;
        });

        // uiGmapGoogleMapApi.then(function(maps) {
        //     console.log('gmaps API ready');
        // });

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










