(function() {

  // @ngInject
  function Storage($localStorage, $sessionStorage) {

    return {
      /**
       * Store data in local/session storage
       * @param  {[type]} key   the item key to store
       * @param  {[type]} value the data to store
       * @param  {[type]} local to store in local storage instead of session (default)
       * @return {[type]}       [description]
       */
      set: (key, value, local = false) => {
        var data = angular.toJson(value).toString();
        var storageType = local ? $localStorage : $sessionStorage;
        storageType[key] = data;
      },

      get: key => {
        var data = $localStorage[key] || $sessionStorage[key] || null;
        return angular.fromJson(data);
      },

      delete: key => {
        delete $localStorage[key];
        delete $sessionStorage[key];
      }
    };
  }

  angular
    .module('app')
    .service('Storage', Storage);

})();
