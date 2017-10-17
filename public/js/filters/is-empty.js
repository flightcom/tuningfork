(function() {

    function isEmpty() {
        var bar;
        return function (obj) {
            for (bar in obj) {
                if (obj.hasOwnProperty(bar)) {
                    return false;
                }
            }
            return true;
        };
    }

    angular
        .module('app')
        .filter('isEmpty', isEmpty);

})();
