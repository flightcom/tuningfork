(function () {

    let pret = {
        templateUrl: 'public/dist/html/components/pret.html',
        controller: PretController,
        controllerAs: '$pretCtrl',
        bindings: {
            item: '=?',
            instrument: '<?',
            user: '<?'
        }
    };

    // @ngInject
    function PretController ($q, $mdDialog, $state, Pret, Utils, Toast, Navigation) {

        var vm = this;
        vm.item = vm.item || {};
        vm.isNew = !vm.item.id;
        vm.item.instrument = vm.item.instrument || vm.instrument || null;
        vm.item.user = vm.item.user || vm.user || null;

        vm.isLoading = false;
        vm.previous = Utils.previous;

        vm.start = () => {
            vm.item.dateDebut = new Date();
            vm.onChange();
        };

        vm.stop = () => {
            vm.item.dateFin = new Date();
            vm.onChange();
        };

        vm.updateEndDate = () => {
            console.log('update end date');
            vm.item.dateFinPrevue = calculateDateFinPrevue(vm.item.dateDebutPrevue);
            // vm.onChange();
        };

        vm.onChange = () => {
            let method = vm.item.id ? 'update':'save';
            // vm.isLoading = true;
            Pret[method](vm.item)
            .then(response => {
                // vm.item = response;
                // Toast.success('Mise à jour réussie');
                if (method === 'save') {
                    Navigation.parent();
                }
            // }).catch(error => {
            //     Toast.error(error);
            // }).finally( () => {
            //     vm.isLoading = false;
            });
        };

        vm.resetForm = form => {
            vm.item = {}; // this resets the model
            form.$setPristine(); // this resets the form itself
        };

        vm.setDateDebutPrevueToday = () => {
            vm.item.dateDebutPrevue = new Date();
            vm.item.dateFinPrevue = calculateDateFinPrevue(vm.item.dateDebutPrevue);
        };

        vm.delete = () => {
            Pret.delete(vm.item.id).then(response => {
                console.log(response);
                $state.go('^');
            });
        };

        vm.deleteInstrument = () => {
            delete vm.item.instrument;
        };

        vm.deleteUser = () => {
            delete vm.item.user;
        };

        const select = answer => {
            $mdDialog.hide(answer);
        };

        vm.selectUser = ev => {
            $mdDialog.show({
                template: '<users-list embedded on-select="$mdDialogSelectUsertCtrl.select(user)"></users-list>',
                controller: ($mdDialog) => {
                    var vm = this;
                },
                controllerAs: '$mdDialogSelectUsertCtrl',
                locals: {
                    select: select
                },
                parent: angular.element(document.body),
                targetEvent: ev,
                skipHide: true,
                bindToController: true,
                clickOutsideToClose:true,
                fullscreen: this.customFullscreen // Only for -xs, -sm breakpoints.
            }).then(function(answer) {
                vm.item.user = answer;
            }, function() {
                console.log('Dialog canceled');
            });
        };

        vm.selectInstrument = ev => {

            $mdDialog.show({
                template: '<instruments-list embedded on-select="$mdDialogSelectInstrumentCtrl.select(instrument)"></instruments-list>',
                controller: ($mdDialog) => {
                    var vm = this;
                },
                controllerAs: '$mdDialogSelectInstrumentCtrl',
                locals: {
                    select: select
                },
                parent: angular.element(document.body),
                targetEvent: ev,
                clickOutsideToClose:true,
                bindToController: true,
                fullscreen: this.customFullscreen // Only for -xs, -sm breakpoints.
            }).then(function(answer) {
                vm.item.instrument = answer;
            }, function() {
                console.log('Dialog canceled');
            });
        };

        const calculateDateFinPrevue = (date) => {
            let endDate = moment(date).month('June').endOf('month').endOf('day');
            endDate.add(endDate > date ? 0:1, 'years');
            endDate.subtract((endDate.day() + 2) % 7, 'days');
            return endDate.toDate();
        };

    }

    angular.module('app')
        .component('pret', pret);

})();
