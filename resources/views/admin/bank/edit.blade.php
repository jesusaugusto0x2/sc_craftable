@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.bank.actions.edit', ['name' => $bank->name]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <bank-form
                :action="'{{ $bank->resource_url }}'"
                :data="{{ $bank->toJson() }}"
                v-cloak
                inline-template>

                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> Editar Banco - {{$bank->name}}
                    </div>

                    <div class="card-body">
                        @include('admin.bank.components.form-elements')
                    </div>


                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            Guardar
                        </button>
                    </div>

                </form>

        </bank-form>

        </div>

</div>

@endsection
