(function () {

    // @ngInject
    function Marque($resource, $mdDialog, Utils, Toast, HTTPCreator) {
        var resource = $resource('/api/marques/:id', {id: '@id'}, {
            query: { isArray: false },
            update: {method: 'PUT'}
        });

        var methods = {
            query: function() {
                return resource.query().$promise;
            },
            get: function(id) {
                return resource.get({id: id}).$promise;
            },
            save: function(data) {
                return resource.save(data).$promise;
            },
            update: function(data) {
                return resource.update(data).$promise;
            },
            delete: function(id) {
                return resource.$delete({id: id}).$promise;
            },
            prompt: event => {
                let confirm = $mdDialog.prompt({
                    parent: angular.element(document.body),
                    targetEvent: event,
                    skipHide: true,
                    clickOutsideToClose:true,
                    fullscreen: this.customFullscreen,
                    title: 'Ajouter une marque',
                    placeholder: 'Nom',
                    ok: 'Enregistrer',
                    cancel: 'Annuler'
                });

                return $mdDialog.show(confirm).then(answer => {
                    Utils.startWait();
                    return methods.save({nom: answer})
                    .then(response => {
                        Toast.success('Marque ajoutée');
                        return response;
                    }).catch(error => {
                        Toast.error('Une erreur est survenue lors de l\'ajout de la marque ' + answer);
                        throw 'Une erreur est survenue lors de l\'ajout de la marque ' + answer;
                    }).finally(() => {
                        Utils.endWait();
                    });
                }, () => {
                    throw 'Fenetre fermée';
                });

            }
        };

        return methods;

    }

    angular
        .module('app')
        .factory('Marque', Marque)

})();

