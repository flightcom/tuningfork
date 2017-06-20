(function () {

    // @ngInject
    function Form() {

        var FormService = {};

        FormService.set = (form, scope) => {
            FormService.form = form;
            scope.$emit('formUpdated', {form: FormService.form});
        };

        FormService.get = () => {
            return FormService.form;
        };

        return FormService;
    }

    angular
        .module('app')
        .service('Form', Form);

})();
