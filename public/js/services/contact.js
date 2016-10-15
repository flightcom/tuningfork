(function () {

    // @ngInject
    function Contact($http, $q, Alert) {
        var url = '/api/contact/';

        return {
            post: function(data) {
                var defer = $q.defer();
                $http.post(url, data).then(function(response){
                    Alert.success("Le mail a bien été envoyé");
                    defer.resolve(response);
                }).catch(function(error){
                    Alert.error("Erreur lors de l'envoi du mail");
                });
                return defer.promise;
            }
        };
    }

    angular
        .module('app')
        .factory('Contact', Contact)

})();

