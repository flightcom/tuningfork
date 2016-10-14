(function () {

    // @ngInject
    function ContactCtrl($scope, $http, $filter){

        $scope.splashContact = function() {
            return false;
        }

    }

    angular
        .module('app')
        .controller('ContactCtrl', ContactCtrl);

})();










