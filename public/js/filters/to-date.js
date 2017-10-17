(function() {

    function toDate(){
        return function(input) {
            return new Date(input);
        }
    }

    angular
        .module('app')
        .filter('toDate', toDate)

})();