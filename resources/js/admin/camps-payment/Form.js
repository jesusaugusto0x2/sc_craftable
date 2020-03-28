import AppForm from '../app-components/Form/AppForm';

Vue.component('camps-payment-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                reference:  '' ,
                photo:  '' ,
                date:  '' ,
                validated:  false ,
                method_id:  '' ,
                camp_id:  '' ,
                user_id:  '' ,
                bank_id:  '' ,
                
            }
        }
    }

});