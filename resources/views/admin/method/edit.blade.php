@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.method.actions.edit', ['name' => $method->name]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <method-form
                :action="'{{ $method->resource_url }}'"
                :data="{{ $method->toJson() }}"
                v-cloak
                inline-template>

                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> Editar Método de Pago - {{$method->name}}
                    </div>

                    <div class="card-body">
                        @include('admin.method.components.form-elements')
                    </div>


                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            Guardar
                        </button>
                    </div>

                </form>

        </method-form>

        </div>

</div>

@endsection
