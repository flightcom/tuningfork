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

        // Instruments
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
            views: {
                'admin@admin': {
                    templateUrl: PATHS.TEMPLATE + 'partials/admin/instrument.html',
                    controller: 'AdminInstrumentViewCtrl as $adminInstrumentViewCtrl'
                }
            }
        }

        // Prets
        let adminPrets = {
            name: 'admin.prets',
            url: '/prets',
            views: {
                'admin': {
                    templateUrl: PATHS.TEMPLATE + 'partials/admin/prets.html',
                    controller: 'AdminPretsCtrl as $adminPretsCtrl'
                }
            }
        }

        let adminPretsView = {
            name: 'admin.prets.view',
            url: '/:id',
            views: {
                'admin@admin': {
                    templateUrl: PATHS.TEMPLATE + 'partials/admin/pret.html',
                    controller: 'AdminPretViewCtrl as $adminPretViewCtrl'
                }
            }
        }

        // Users
        let adminUsers = {
            name: 'admin.users',
            url: '/users',
            views: {
                'admin': {
                    templateUrl: PATHS.TEMPLATE + 'partials/admin/users.html',
                    controller: 'AdminUsersCtrl as $adminUsersCtrl'
                }
            }
        }

        let adminUsersAdd = {
            name: 'admin.users_add',
            url: '/users/add',
            templateUrl: PATHS.TEMPLATE + 'partials/admin/forms/user.html',
        }

        let adminUsersView = {
            name: 'admin.users.view',
            url: '/:id',
            views: {
                'admin@admin': {
                    templateUrl: PATHS.TEMPLATE + 'partials/admin/user.html',
                    controller: 'AdminUserViewCtrl as $adminUserViewCtrl'
                }
            }
        }

        $stateProvider.state(admin);
        $stateProvider.state(adminDashboard);
        $stateProvider.state(adminInstruments);
        $stateProvider.state(adminInstrumentsView);
        $stateProvider.state(adminPrets);
        $stateProvider.state(adminPretsView);
        $stateProvider.state(adminUsers);
        $stateProvider.state(adminUsersAdd);
        $stateProvider.state(adminUsersView);

    }

    angular.module('app')
        .config(admin);

})();
