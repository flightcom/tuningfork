(function() {

  // @ngInject
  function SecuredStorage($localStorage, $sessionStorage) {

    var secretKey = 'XC6N1BZWlxsLpq%hYp^#';

    return {
      /**
       * Store data in local/session storage
       * @param  {[type]} key   the item key to store
       * @param  {[type]} value the data to store
       * @param  {[type]} local to store in local storage instead of session (default)
       * @return {[type]}       [description]
       */
      store: function(key, value, local) {
        var encryptedData = CryptoJS.AES.encrypt(angular.toJson(value), secretKey).toString();
        var storageType = local ? $localStorage : $sessionStorage;
        storageType[key] = encryptedData;
      },

      get: function(key) {
        var encryptedData = $localStorage[key] || $sessionStorage[key] || null;

        if (!_.isNull(encryptedData)) {
          return angular.fromJson(CryptoJS.AES.decrypt(encryptedData, secretKey).toString(CryptoJS.enc.Utf8));
        }

        return null;
      }
    };
  }

  angular
    .module('app')
    .service('SecuredStorage', SecuredStorage);

})();
