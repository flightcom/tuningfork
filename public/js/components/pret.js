(function () {

    let pret = {
        templateUrl: 'public/dist/html/components/pret.html',
        controller: PretController,
        controllerAs: '$pretCtrl',
        bindings: {
            id: '<id'
        }
    }

    // @ngInject
    function PretController ($q, Pret, Utils, Toast) {

        var vm = this;

        vm.isLoading = false;
        vm.previous = Utils.previous;

        vm.start = () => {
            vm.item.dateDebut = new Date();
            vm.onChange();
        }

        vm.stop = () => {
            vm.item.dateFin = new Date();
            vm.onChange();
        }

        vm.checkStartDate = () => {
            vm.item.dateFinPrevue = calculateDateFinPrevue(vm.item.dateDebutPrevue);
            vm.onChange();
        }

        vm.onChange = () => {
            vm.isLoading = true;
            Pret.update(vm.item)
            .then(response => {
                vm.item = response;
                Toast.success('Mise à jour réussie');
            }).catch(error => {
                Toast.error(error);
            }).finally( () => {
                vm.isLoading = false;
            });
        }

        vm.load = () => {
            vm.isLoading = true;
            vm.promise = Pret.get(vm.id).then(response => {
                vm.isLoading = false;
                vm.item = response;
            });
        }

        const calculateDateFinPrevue = (date) => {
            let endDate = moment(date).month('June').endOf('month').endOf('day');
            endDate.add(endDate > date ? 0:1, 'years');
            endDate.subtract((endDate.day() + 2) % 7, 'days');
            return endDate.toDate();
        }

        vm.load();

    }

    angular.module('app')
        .component('pret', pret);

})();
