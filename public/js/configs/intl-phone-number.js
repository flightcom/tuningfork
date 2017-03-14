(function () {

    // @ngInject
    function intlPhoneNumber(intlTelInputOptions){
        angular.extend(intlTelInputOptions, {
            nationalMode: false,
            utilsScript: '../node_modules/intl-tel-input/build/js/utils.js',
            defaultCountry: 'auto',
            preferredCountries: ['fr', 'be', 'uk', 'es'],
            autoFormat: true,
            formatOnDisplay: true,
            autoPlaceholder: true,
            treatEmptyInputAsValidForm: true
        });
    }

    angular.module('app')
        .config(intlPhoneNumber);

})();
