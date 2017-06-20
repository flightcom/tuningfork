(() => {

    let instrumentSimple = {
        templateUrl: 'public/dist/html/components/instrument-simple.html',
        controller: InstrumentSimpleController,
        controllerAs: '$instrumentSimpleCtrl',
        require: 'ngModel',
        bindings: {
            item: '=ngModel'
        }
    };

    // @ngInject
    function InstrumentSimpleController () {

        var vm = this;

    }

    angular.module('app')
        .component('instrumentSimple', instrumentSimple);

})();
