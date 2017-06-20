( () => {

    // @ngInject
    function AdminController ($mdMedia) {

        var vm = this;
        this.isSideNavOpen = $mdMedia('gt-xs');

    }

    angular
        .module('app')
        .controller('AdminCtrl', AdminController);

})();
