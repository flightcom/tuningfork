(function () {

    // @ngInject
    function Pret($resource, HTTPCreator) {

        const resource = $resource('/api/prets/:id', {id: '@id'}, {
            update: {method: 'PUT'},
            search  : {method: 'GET', url: '/api/prets/search'},
            endingDate  : {method: 'GET', url: '/api/prets/ending-date/:date', params: {date: '@date'}},
        });

        return {
            query: function() {
                return resource.query().$promise;
            },
            get: function(id) {
                return resource.get({id: id}).$promise
                .then(response => {
                    return this.format(response.data);
                }).catch(error => {
                    throw new Error(error);
                });
            },
            search: function(data) {
                return resource.search(data).$promise;
            },
            count: function(data) {
                data.count = true;
                return resource.search(data).$promise;
            },
            save: function(data) {
                return resource.save(data).$promise;
            },
            update: function(data) {
                return resource.update({id: data.id}, data).$promise
                .then(response => {
                    return this.format(response.data);
                })
                .catch(error => {
                    throw new Error(error);
                });
            },
            delete: function(id) {
                return resource.$delete({id: id}).$promise;
            },
            format: function(pret) {
                pret.dateDebutPrevue = pret.dateDebutPrevue ? new Date(pret.dateDebutPrevue) : null;
                pret.dateDebut       = pret.dateDebut ? new Date(pret.dateDebut) : null;
                pret.dateFinPrevue   = pret.dateFinPrevue ? new Date(pret.dateFinPrevue) : null;
                pret.dateFin         = pret.dateFin ? new Date(pret.dateFin) : null;
                return pret;
            }
        };
    }

    angular
        .module('app')
        .factory('Pret', Pret)

})();

