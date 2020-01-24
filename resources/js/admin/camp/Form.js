import AppForm from '../app-components/Form/AppForm';

Vue.component('camp-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                location:  '' ,
                entries:  '' ,
                cost:  '' ,
                date:  '' ,
                
            }
        }
    }

});