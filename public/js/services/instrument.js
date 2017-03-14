(function () {

    // @ngInject
    function Instrument($resource, HTTPCreator) {
        var resource = $resource('/api/instruments/:id/:action', {
                id: '@id',
                action: '@action'
            }, {
            update  : {method: 'PUT'},
            search  : {method: 'GET', url: '/api/instruments/search'},
            count   : {method: 'GET', url: '/api/instruments/count'},
            barcode : {method: 'GET', url: '/api/instruments/barcode'}
        });

        return {
            query: function() {
                return resource.query().$promise;
            },
            get: function(id) {
                return resource.get({id: id}).$promise;
            },
            search: function(data) {
                return resource.search(data).$promise;
            },
            count: function(data) {
                return resource.count(data).$promise;
            },
            save: function(data) {
                return resource.save(data).$promise;
            },
            update: function(data) {
                return resource.update({id: data.id}, data).$promise;
            },
            delete: function(id) {
                return resource.delete({id: id}).$promise;
            },
            barcode: function () {
                return resource.barcode().$promise;
            },
            prets: function (id) {
                return resource.get({id: id, action: 'prets'}).$promise;
            }
        };
    }

    angular
        .module('app')
        .factory('Instrument', Instrument)

})();

