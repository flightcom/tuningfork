(function () {

    // @ngInject
    function SplashCtrl($http, $sce, Station, Contact, Alert, NgMap, GOOGLE_MAPS_API){

        var vm = this;
        vm.defaultUser = {}
        vm.currentUser = angular.copy(vm.defaultUser);
        vm.googleMapsUrl = GOOGLE_MAPS_API.url + '?key=' + GOOGLE_MAPS_API.key;

        Station.query().then(function(response) {
            vm.stations = response;
        });

        NgMap.getMap().then(function(map) {
            vm.map = map;
        });

        vm.contact = function() {
            Contact.save(vm.currentUser)
            .then(function(success){
                Alert.success(success.text);
                vm.resetContactForm();
            }).catch(function(error){
                Alert.error(error.text);
            });
            return false;
        };

        vm.resetContactForm = function() {
            vm.currentUser = angular.copy(vm.defaultUser);
            vm.contactForm.$setPristine();
            vm.contactForm.$setUntouched();
        };

        vm.showStationDetails = function(e, station) {
            vm.station = station;
            vm.map.showInfoWindow('info-window-station', 'marker-station-' + station.id);
        };

    }

    angular
        .module('app')
        .controller('SplashCtrl', SplashCtrl);

})();










