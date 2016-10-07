(function () {

    // @ngInject
    function SplashCtrl($http, Station, Contact, Alert){

        var vm = this;
        vm.currentUser = {};

        // Station.query().then(function(response) {
        //     console.log(response);
        //     $scope.stations = response;
        // });

        // uiGmapGoogleMapApi.then(function(maps) {
        //     console.log('gmaps API ready');
        // });

        // Station.get(43).then(function(response) {
        //     console.log(response);
        //     $scope.stations = response;
        // });

        vm.contact = function() {
            console.log(vm.currentUser);
            Contact.post(vm.currentUser);
            return false;
        };

    }

    angular
        .module('app')
        .controller('SplashCtrl', SplashCtrl);

})();










