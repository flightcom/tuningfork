(() => {

    let userSimple = {
        templateUrl: 'public/dist/html/components/user-simple.html',
        controller: UserSimpleController,
        controllerAs: '$userSimpleCtrl',
        require: 'ngModel',
        bindings: {
            item: '=ngModel'
        }
    };

    // @ngInject
    function UserSimpleController () {

        var vm = this;

    }

    angular.module('app')
        .component('userSimple', userSimple);

})();
