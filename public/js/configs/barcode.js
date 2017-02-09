(function () {

    // @ngInject
    function barcode($rootScope){

        $rootScope.bc = {
            format: 'EAN13',
            lineColor: '#000000',
            width: 2,
            height: 100,
            displayValue: true,
            fontOptions: '',
            font: 'monospace',
            textAlign: 'center',
            textPosition: 'bottom',
            textMargin: 2,
            fontSize: 20,
            background: '#ffffff',
            margin: 0,
            marginTop: undefined,
            marginBottom: undefined,
            marginLeft: undefined,
            marginRight: undefined,
            valid: function (valid) {}
        }
    }

    angular.module('app')
        .run(barcode);

})();
