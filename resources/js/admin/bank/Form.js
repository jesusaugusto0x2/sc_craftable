import AppForm from '../app-components/Form/AppForm';

Vue.component('bank-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                
            }
        }
    }

});