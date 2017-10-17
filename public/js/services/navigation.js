(function () {

    // @ngInject
    function Navigation ($rootScope, $state) {

        var NavigationService = {
            exists: false,
            states: []
        };

        NavigationService.previous = () => {
            if (prev = NavigationService.states[NavigationService.states.length-1]) {
                window.location.href = prev;
            }
        };

        NavigationService.parent = () => {
            console.log('navigate to parent');
            $state.go('^');
        };


        NavigationService.process = (ev, to, toParams, from, fromParams) => {
            let fromURL = $state.href(from.name, fromParams, {absolute: false});
            let toURL   = $state.href(to.name, toParams, {absolute: false});
            let prevURL = NavigationService.states[NavigationService.states.length - 1];

            if (toURL !== prevURL) {
                NavigationService.states.push(fromURL);
            } else {
                NavigationService.states.pop();
            }

            NavigationService.exists = NavigationService.states.length > 0;
        };

        return NavigationService;
    };

    angular
        .module('app')
        .service('Navigation', Navigation);

})();
