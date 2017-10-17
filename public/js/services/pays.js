(function () {

    // @ngInject
    function Pays($resource, HTTPCreator) {
        var resource = $resource('/api/pays/:id', {id: '@id'}, {
            query: {isArray: false}
        });

        return {
            query: function() {
                return resource.query().$promise;
            },
            get: function(id) {
                return resource.get({id: id}).$promise;
            }
        };
    }

    angular
        .module('app')
        .factory('Pays', Pays);

})();
