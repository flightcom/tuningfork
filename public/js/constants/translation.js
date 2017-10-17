(() => {

    angular.module('app')
        .constant('TRANSLATE', {
            PRET: {
                STATUS: {
                    AWAITING : "En attente",
                    RUNNING  : "En cours",
                    CLOSED   : "Clos",
                    CANCELED : "Annulé",
                    MISSING  : "Manquant",
                }
            }
        });

})();


