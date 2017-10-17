(function () {

    // @ngInject
    const History = ($rootScope, $state) => {

        var HistoryService = {
            exists: false,
            states: []
        };

        HistoryService.prev = () => {
            if (prev = HistoryService.states[HistoryService.states.length-1]) {
                window.location.href = prev;
            }
        };

        HistoryService.process = (ev, to, toParams, from, fromParams) => {
            let fromURL = $state.href(from.name, fromParams, {absolute: false});
            let toURL   = $state.href(to.name, toParams, {absolute: false});
            let prevURL = HistoryService.states[HistoryService.states.length - 1];

            if (toURL !== prevURL) {
                HistoryService.states.push(fromURL);
            } else {
                HistoryService.states.pop();
            }

            HistoryService.exists = HistoryService.states.length > 0;
        };

        return HistoryService;
    };

    angular
        .module('app')
        .service('History', History);

})();
