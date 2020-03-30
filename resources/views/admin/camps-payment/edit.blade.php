@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.camps-payment.actions.edit', ['name' => $campsPayment->id]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <camps-payment-form
                :action="'{{ $campsPayment->resource_url }}'"
                :data="{{ $campsPayment->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.camps-payment.actions.edit', ['name' => $campsPayment->id]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.camps-payment.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </camps-payment-form>

        </div>
    
</div>

@endsection