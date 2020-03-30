<div class="form-group row align-items-center" :class="{'has-danger': errors.has('reference'), 'has-success': fields.reference && fields.reference.valid }">
    <label for="reference" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.camps-payment.columns.reference') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.reference" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('reference'), 'form-control-success': fields.reference && fields.reference.valid}" id="reference" name="reference" placeholder="{{ trans('admin.camps-payment.columns.reference') }}">
        <div v-if="errors.has('reference')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('reference') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('photo'), 'has-success': fields.photo && fields.photo.valid }">
    <label for="photo" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.camps-payment.columns.photo') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.photo" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('photo'), 'form-control-success': fields.photo && fields.photo.valid}" id="photo" name="photo" placeholder="{{ trans('admin.camps-payment.columns.photo') }}">
        <div v-if="errors.has('photo')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('photo') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('date'), 'has-success': fields.date && fields.date.valid }">
    <label for="date" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.camps-payment.columns.date') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div class="input-group input-group--custom">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <datetime v-model="form.date" :config="datetimePickerConfig" v-validate="'date_format:yyyy-MM-dd HH:mm:ss'" class="flatpickr" :class="{'form-control-danger': errors.has('date'), 'form-control-success': fields.date && fields.date.valid}" id="date" name="date" placeholder="{{ trans('brackets/admin-ui::admin.forms.select_date_and_time') }}"></datetime>
        </div>
        <div v-if="errors.has('date')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('date') }}</div>
    </div>
</div>

<div class="form-check row" :class="{'has-danger': errors.has('validated'), 'has-success': fields.validated && fields.validated.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="validated" type="checkbox" v-model="form.validated" v-validate="''" data-vv-name="validated"  name="validated_fake_element">
        <label class="form-check-label" for="validated">
            {{ trans('admin.camps-payment.columns.validated') }}
        </label>
        <input type="hidden" name="validated" :value="form.validated">
        <div v-if="errors.has('validated')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('validated') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('method_id'), 'has-success': fields.method_id && fields.method_id.valid }">
    <label for="method_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.camps-payment.columns.method_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.method_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('method_id'), 'form-control-success': fields.method_id && fields.method_id.valid}" id="method_id" name="method_id" placeholder="{{ trans('admin.camps-payment.columns.method_id') }}">
        <div v-if="errors.has('method_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('method_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('camp_id'), 'has-success': fields.camp_id && fields.camp_id.valid }">
    <label for="camp_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.camps-payment.columns.camp_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.camp_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('camp_id'), 'form-control-success': fields.camp_id && fields.camp_id.valid}" id="camp_id" name="camp_id" placeholder="{{ trans('admin.camps-payment.columns.camp_id') }}">
        <div v-if="errors.has('camp_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('camp_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('user_id'), 'has-success': fields.user_id && fields.user_id.valid }">
    <label for="user_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.camps-payment.columns.user_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.user_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('user_id'), 'form-control-success': fields.user_id && fields.user_id.valid}" id="user_id" name="user_id" placeholder="{{ trans('admin.camps-payment.columns.user_id') }}">
        <div v-if="errors.has('user_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('user_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('bank_id'), 'has-success': fields.bank_id && fields.bank_id.valid }">
    <label for="bank_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.camps-payment.columns.bank_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.bank_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('bank_id'), 'form-control-success': fields.bank_id && fields.bank_id.valid}" id="bank_id" name="bank_id" placeholder="{{ trans('admin.camps-payment.columns.bank_id') }}">
        <div v-if="errors.has('bank_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('bank_id') }}</div>
    </div>
</div>


