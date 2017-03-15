(function () {

    // @ngInject
    function RegisterCtrl($scope, $sessionStorage, $window, Utils, Toast, Ville, Pays, User, Authentication, TYPEAHEAD){

        var vm = this;
        vm.user = {};
        vm.sessionStorage = $sessionStorage;
        vm.TYPEAHEAD = TYPEAHEAD;

        Pays.query().then(function(response){
            vm.countries = response;
        }).catch(function(error) {
            Toast.error(error.text);
        });

        vm.resetContactForm = function () {
            vm.currentUser = angular.copy(vm.defaultUser);
            vm.contactForm.$setPristine();
            vm.contactForm.$setUntouched();
        };

        vm.signup = function () {
            User.signup(vm.user).then(function(response){
                console.log(response);
                Toast.success('Membre ajouté !');
            }).catch(function(error) {
                Toast.error(error);
            });
        }

        vm.login = function () {
            Utils.loading();
            Authentication.login(vm.user).then(function(response){
                const cb = () => {
                    // $scope.$emit('userLogin', response.data);
                    $window.location.href = '/';
                    // $state.go('public.splash.child');
                };
                Toast.success('Connexion réussie !');
                cb();
                vm.sessionStorage.user = response.data;
            }).catch(function(response) {
                Toast.error(response);
            }).finally( () => {
                Utils.loading(false);
            });
        }

        vm.getVilles = function (query) {
            var defer = $q.defer();
            Ville.filter({nomReel: query, limit: vm.TYPEAHEAD.VILLES.MAX_RESULTS})
            .then(function(response) {
                defer.resolve(response);
            }).catch(function(error) {
                Toast.error(error.text);
            });

            return defer.promise;
        }

        vm.check = () => {
            console.log('Checking...');
            return Authentication.check().then(response => {
                console.log(response);
            })
        }

    }

    angular
        .module('app')
        .controller('RegisterCtrl', RegisterCtrl);

})();










