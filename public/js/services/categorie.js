(function () {

    // @ngInject
    function Categorie($resource, $mdDialog, Toast, Utils) {
        var resource = $resource('/api/categories/:id/:action',
        {
            // id: '@id',
            // action: '@action',
            // action: '@action'
        }, {
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
            search: function (data) {
                return resource.get({
                    action: 'search',
                    params: data
                }).$promise;
                // return resource.get({action: 'search'}, data).$promise;
            },
            prompt: (event, parent) => {
                let confirm = $mdDialog.prompt({
                    parent: angular.element(document.body),
                    targetEvent: event,
                    skipHide: true,
                    clickOutsideToClose:true,
                    fullscreen: this.customFullscreen,
                    title: 'Ajouter une catégorie',
                    placeholder: 'Nom',
                    ok: 'Enregistrer',
                    cancel: 'Annuler'
                });

                return $mdDialog.show(confirm).then(answer => {
                    Utils.startWait();
                    return methods.save({
                        nom: answer,
                        parent: parent
                    }).then(response => {
                        Toast.success('Catégorie ajoutée');
                        return response;
                    }).catch(error => {
                        Toast.error('Une erreur est survenue lors de l\'ajout de la catégorie ' + answer);
                        throw 'Une erreur est survenue lors de l\'ajout de la catégorie ' + answer;
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
        .factory('Categorie', Categorie)

})();

