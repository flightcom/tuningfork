(function () {

    // @ngInject
    function Contact($http, Alert) {
        var url = '/api/contact/';

        return {
            post: function(data) {
                return $http.post(url, data).then(function(response){
                    console.log(response);
                    Alert.success("Le mail a bien été envoyé");
                }).catch(function(error){
                    Alert.error("Erreur lors de l'envoi du mail");
                });
            }
        };
    }

    angular
        .module('app')
        .factory('Contact', Contact)

})();

