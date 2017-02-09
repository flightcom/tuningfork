(function () {

    // @ngInject
    function admin($stateProvider, PATHS){

        let admin = {
            name: 'admin',
            url: '/admin',
            templateUrl: PATHS.TEMPLATE + 'layouts/admin.html'
        }

        let adminDashboard = {
            name: 'admin.dashboard',
            url: '/',
            templateUrl: PATHS.TEMPLATE + 'partials/admin/dashboard.html',
        }

        let adminInstruments = {
            name: 'admin.instruments',
            url: '/instruments',
            views: {
                'admin': {
                    templateUrl: PATHS.TEMPLATE + 'partials/admin/instruments.html',
                    controller: 'AdminInstrumentsCtrl as $adminInstrumentsCtrl'
                }
            }
        }

        let adminInstrumentsAdd = {
            name: 'admin.instruments_add',
            url: '/instruments/add',
            templateUrl: PATHS.TEMPLATE + 'partials/admin/forms/instrument.html',
        }

        let adminInstrumentsView = {
            name: 'admin.instruments.view',
            url: '/:id',
            params: {
                instrument: null
            },
            views: {
                'admin@admin': {
                    templateUrl: PATHS.TEMPLATE + 'partials/admin/instrument.html',
                    controller: 'AdminInstrumentViewCtrl as $adminInstrumentViewCtrl'
                }
            }
        }

        let adminUsers = {
            name: 'admin.users',
            url: '/users',
            templateUrl: PATHS.TEMPLATE + 'partials/admin/users.html',
        }

        let adminUsersAdd = {
            name: 'admin.users_add',
            url: '/users/add',
            templateUrl: PATHS.TEMPLATE + 'partials/admin/forms/user.html',
        }

        $stateProvider.state(admin);
        $stateProvider.state(adminDashboard);
        $stateProvider.state(adminInstruments);
        $stateProvider.state(adminInstrumentsView);
        // $stateProvider.state(adminInstrumentsAdd);
        $stateProvider.state(adminUsers);
        $stateProvider.state(adminUsersAdd);

    }

    angular.module('app')
        .config(admin);

})();
