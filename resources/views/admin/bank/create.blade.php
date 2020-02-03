@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.bank.actions.create'))

@section('body')

    <div class="container-xl">

        <div class="card">

        <bank-form
            :action="'{{ url('admin/banks') }}'"
            v-cloak
            inline-template>

            <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit" :action="action" novalidate>

                <div class="card-header">
                    <i class="fa fa-plus"></i> Crear Banco
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
