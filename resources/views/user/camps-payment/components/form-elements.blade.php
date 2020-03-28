<div class="form-group row align-items-center" :class="{'has-danger': errors.has('reference'), 'has-success': fields.reference && fields.reference.valid }">
    <label for="reference" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">Referencia</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.reference" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('reference'), 'form-control-success': fields.reference && fields.reference.valid}" id="reference" name="reference" placeholder="referencia">
        <div v-if="errors.has('reference')" class="form-control-feedback form-text" v-cloak>la referencia es obligatoria</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('date'), 'has-success': fields.date && fields.date.valid }">
    <label for="date" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">Fecha</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div class="input-group input-group--custom">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <datetime v-model="form.date" :config="datetimePickerConfig" v-validate="'date_format:yyyy-MM-dd HH:mm:ss', 'required'" class="flatpickr" :class="{'form-control-danger': errors.has('date'), 'form-control-success': fields.date && fields.date.valid}" id="date" name="date" placeholder="2020-01-01"></datetime>
        </div>
        <div v-if="errors.has('date')" class="form-control-feedback form-text" v-cloak>la fecha es obligatoria</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('bank_id'), 'has-success': fields.bank_id && fields.bank_id.valid }">
    <label for="bank_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">Banco</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <select type="text" v-model="form.bank_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('bank_id'), 'form-control-success': fields.bank_id && fields.bank_id.valid}" id="bank_id" name="bank_id" placeholder="{{ trans('admin.camps-payment.columns.bank_id') }}">
            @foreach ($banks as $bank)
                <option value="{{$bank->id}}">{{$bank->name}} </option>
            @endforeach
        </select>
        <div v-if="errors.has('bank_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('bank_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('method_id'), 'has-success': fields.method_id && fields.method_id.valid }">
    <label for="method_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">Metodo de pago</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <select type="text" v-model="form.method_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('method_id'), 'form-control-success': fields.method_id && fields.method_id.valid}" id="method_id" name="method_id" placeholder="{{ trans('admin.camps-payment.columns.method_id') }}">
            @foreach ($methods as $method)
                <option value="{{$method->id}}">{{$method->name}} </option>
            @endforeach
        </select>
        <div v-if="errors.has('method_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('method_id') }}</div>
    </div>
</div>

