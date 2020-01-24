import AppForm from '../app-components/Form/AppForm';

Vue.component('method-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                
            }
        }
    }

});