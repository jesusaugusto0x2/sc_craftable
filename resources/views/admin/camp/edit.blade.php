@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.camp.actions.edit', ['name' => $camp->id]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <camp-form
                :action="'{{ $camp->resource_url }}'"
                :data="{{ $camp->toJson() }}"
                v-cloak
                inline-template>

                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>
                    <div class="card-header">
                        <i class="fa fa-pencil"></i> Editar Campamento - {{$camp->location}}
                    </div>

                    <div class="card-body">
                        @include('admin.camp.components.form-elements')
                    </div>


                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>

                </form>

        </camp-form>

        </div>

</div>

@endsection
