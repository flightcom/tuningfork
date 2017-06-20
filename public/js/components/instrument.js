(function () {

    let instrument = {
        templateUrl: 'public/dist/html/components/instrument.html',
        controller: InstrumentController,
        controllerAs: '$instrumentCtrl',
        bindings: {
            item: '<?'
        }
    };

    // @ngInject
    function InstrumentController ($q, $rootScope, $state, $mdDialog, Instrument, Marque, Utils, Toast, Categorie) {

        var vm = this;

        vm.bc = $rootScope.bc;
        vm.Navigation = $rootScope.Navigation;
        vm.item = vm.item || {};
        vm.item.categories = vm.item.categories || [];
        vm.isNew = !vm.item.id;

        vm.onChange = () => {
            Utils.loading();
            let method = vm.item.id ? 'update' : 'save';
            return Instrument[method](vm.item)
            .then(response => {
                vm.item = response.data;
                Toast.success('Mise à jour réussie');
            }).catch(error => {
                Toast.error("Erreur lors de l'enregistrement", error);
            }).finally( () => {
                Utils.loading(false);
            });
        };

        vm.generateBarcode = () => {
            Instrument.barcode().then(response => {
                vm.item.barcode = response.data;
                vm.onChange();
            });
        };

        vm.loadMarques = () => {
            Utils.loading();
            return Marque.query().then(response => {
                Utils.loading(false);
                vm.marques = response.data;
            });
        };

        // TODO: remove
        vm.loadCategories = () => {
            Utils.loading();
            return Categorie.query().then(response => {
                Utils.loading(false);
                vm.categories = response.data;
                console.log('categories', vm.categories);
            });
        };

        vm.loadInstrument = () => {
            Utils.loading();
            return Instrument.get(vm.id).then(response => {
                Utils.loading(false);
                vm.item = response.data;
            });
        };

        vm.load = () => {
            Utils.loading();
            let promises = [vm.loadMarques()];
            if (vm.id) promises.push(vm.loadInstrument());
            $q.all(promises).then(responses => {
                Utils.loading(false);
            });
        };

        vm.addMarque = event => {
            Marque.prompt(event).then(response => {
                vm.loadMarques();
            });
        };

        vm.createCategorie = event => {
            Categorie.prompt(event, (vm.item.categories ? vm.item.categories.slice(-1).pop() : null))
            .then(response => {
                console.log(response);
            });
        };

        /**
        * Return the proper object when the append is called.
        */
        vm.transformChip = chip => {
            console.log('TRANSFORM', chip);
            // If it is an object, it's already a known chip
            if (angular.isObject(chip)) {
                return chip;
            }

            // Otherwise, create a new one
            let newCategorie = {
                nom: chip,
                parent: vm.item.categories.slice(-1).pop() || false,
                type: 'new'
            };

            return newCategorie;
        };

        vm.addChip = chip => {
            console.log('ADD');
            vm.searchText = '';
        };

        vm.deleteChip = chip => {
            Utils.wait();
            vm.onChange().then( response => {
                Utils.wait(false);
            });
        };

        vm.searchCategories = query => {
            console.log('search');
            return Categorie.search({
                nom: query,
                parent: vm.item.categories && vm.item.categories.length ? vm.item.categories.slice(-1).pop().id : null
            }).then(response => {
                console.log(response);
                return response.data;
            });
            // console.log('searche', vm.categories);
            // let filteredCategories = _.filter(vm.categories, categorie => {
            //     console.log(query);
            //     return categorie.nom.toLowerCase().startsWith(query.toLowerCase());
            //     // return (vm.item.categories.length > 0 && categorie.parent.id === vm.item.categories.slice(-1).pop().id || vm.item.categories.length === 0)
            //     //     && categorie.nom.startsWith(query);
            // });
            // console.log(filteredCategories);
            // return filteredCategories;
        };

        vm.keydown = $event => {
            console.log('keydown');
            if ($event.keyCode === 13) {
                $event.preventDefault();
            }
        };

        vm.load();

    }

    angular.module('app')
        .component('instrument', instrument);

})();
