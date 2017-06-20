(function() {

  // @ngInject
  function admin($stateProvider, PATHS) {

    let admin = {
      name: 'admin',
      url: '/admin',
      // abstract: true,
      resolve: {
        allowed: (Authentication, $state) => {
          return Authentication.allowed()
          .catch(error => {
            $state.go('login');
          });
        }
      },
      templateUrl: PATHS.TEMPLATE + 'layouts/admin.html',
      controller: 'AdminCtrl',
      controllerAs: '$adminController'
    };

    let adminDashboard = {
      name: 'admin.dashboard',
      url: '/dashboard',
      templateUrl: PATHS.TEMPLATE + 'partials/admin/dashboard.html',
    };

    //-----------------------------------
    // Instruments
    //-----------------------------------
    let adminInstrumentList = {
      name: 'admin.instruments',
      url: '/instruments',
      // resolve: {
      //   instruments: (Instrument, Loading) => {
      //     return Instrument.query().then(response => {
      //       return response.data;
      //     }).finally( () => {
      //       Loading.stop();
      //     });
      //   }
      // },
      views: {
        'admin': {
          template: '<instruments-list items="$resolve.instruments" />'
          // template: '<instruments-list items="$resolve.instruments" />'
        }
      }
    };

    let adminInstrumentCreate = {
      name: 'admin.instruments.create',
      url: '/new',
      views: {
        'admin@admin': {
          template: '<instrument />'
        }
      }
    };

    let adminInstrumentItem = {
      name: 'admin.instruments.view',
      url: '/{id:int}',
      resolve: {
        item: ($stateParams, Instrument) => {
          return $stateParams.instrument || Instrument.get($stateParams.id).then(response => {
            return response.data;
          });
        }
      },
      views: {
        'admin@admin': {
          template: '<instrument item="$resolve.item" />'
        }
      }
    };

    //-----------------------------------
    // Prets
    //-----------------------------------
    let adminPretList = {
      name: 'admin.prets',
      url: '/prets',
      views: {
        'admin': {
          template: '<prets-list />'
        }
      }
    };

    let adminPretItem = {
      name: 'admin.prets.view',
      url: '/{id:int}',
      resolve: {
        item: ($stateParams, Pret, Utils) => {
          Utils.loading(true);
          return Pret.get($stateParams.id).finally( () => {
            Utils.loading(false);
          });
        }
      },
      views: {
        'admin@admin': {
          template: '<pret item="$resolve.item" />'
        }
      }
    };

    let adminPretCreate = {
      name: 'admin.prets.create',
      url: '/new',
      params: {
        item: null,
        instrument: null,
        user: null
      },
      resolve: {
        item: ($stateParams) => {
          return $stateParams.item;
        },
        instrument: ($stateParams) => {
          return $stateParams.instrument;
        },
        user: ($stateParams) => {
          return $stateParams.user;
        }
      },
      views: {
        'admin@admin': {
          template: '<pret item="$resolve.item" instrument="$resolve.instrument" user="$resolve.user" />'
        }
      }
    };

    //-----------------------------------
    // Users
    //-----------------------------------
    let adminUserList = {
      name: 'admin.users',
      url: '/users',
      views: {
        'admin': {
          template: '<users-list />'
        }
      }
    };

    let adminUserCreate = {
      name: 'admin.users.create',
      url: '/new',
      views: {
        'admin@admin': {
          template: '<user-admin-view />'
        }
      }
    };

    let adminUserItem = {
      name: 'admin.users.view',
      url: '/{id:int}',
      resolve: {
        user: ($stateParams, User) => {
          return $stateParams.user || User.get($stateParams.id).then(response => {
            return response;
          });
        },
      },
      views: {
        'admin@admin': {
          template: '<user-admin-view item="$resolve.user" pays="$resolve.pays" />'
        }
      }
    };

    $stateProvider.state(admin);
    $stateProvider.state(adminDashboard);

    $stateProvider.state(adminInstrumentList);
    $stateProvider.state(adminInstrumentItem);
    $stateProvider.state(adminInstrumentCreate);

    $stateProvider.state(adminPretList);
    $stateProvider.state(adminPretItem);
    $stateProvider.state(adminPretCreate);

    $stateProvider.state(adminUserList);
    $stateProvider.state(adminUserItem);
    $stateProvider.state(adminUserCreate);

  }

  angular.module('app')
  .config(admin);

})();
