(function () {

    // @ngInject
    function ContactCtrl($scope, $http, $filter){

        $scope.splashContact = function() {
            console.log($scope.currentUser);
            return false;
        }

    }

    angular
        .module('app')
        .controller('ContactCtrl', ContactCtrl);

})();










