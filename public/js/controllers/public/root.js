(function () {

    // @ngInject
    function RootCtrl($scope, FILES, PATHS) {

        var vm = this;

        vm.FILES = FILES;
        vm.PATHS = PATHS;

        vm.getTitle = function () {
            return vm.title;
        };

        $scope.$on('setTitle', function (title) {
            vm.title = title;
        });

        // $scope.$on('userLogin', function (event, user) {
        //     console.log('user logged in !', user);
        //     vm.user = user;
        // });

    };

    angular
        .module('app')
        .controller('RootCtrl', RootCtrl);

})();

