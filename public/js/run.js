(function() {

  'use strict';

  // @ngInject
  function run($rootScope, $http, $templateCache, $cacheFactory, $location, $state, $anchorScroll, $timeout, FILES, PATHS, Utils, Navigation, Storage, User) {

    // Affectations
    $rootScope.FILES = FILES;
    $rootScope.PATHS = PATHS;
    $rootScope.Navigation = Navigation;
    $rootScope.User = User;
    $rootScope.$state = $state;

    // Functions
    $rootScope.goto = location => {
      window.location.href = location;
    };

    $rootScope.gotoAnchor = (state, anchor) => {
      console.log('test');
      $state.go(state({
        '#': anchor
      }));
    };

    $rootScope.getTemplate = template => {
      return PATHS.TEMPLATE + template;
    };

    // Check if a token already exists
    if (Storage.get('token')) {
        $http.defaults.headers.common.Authorization = 'Bearer ' + Storage.get('token');
    }

  }

  angular
    .module('app')
    .run(run);

})();
