@extends('user.layout.layout')

@section('title', 'Editar perfil')

@section('body')

    <div class="container-xl">

        <div class="card">

            <profile-edit-profile-form
                :action="'{{ url('user/profile') }}'"
                :data="{{ $user->toJson() }}"
                
                inline-template>

                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action">

                    <div class="card-header">
                        <i class="fa fa-pencil"></i> Editar perfil
                    </div>

                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group row align-items-center" :class="{'has-danger': errors.has('name'), 'has-success': fields.name && fields.name.valid }">
                                    <label for="name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-3'">Nombre</label>
                                    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-7'">
                                        <input type="text" v-model="form.name" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('name'), 'form-control-success': fields.name && fields.name.valid}" id="name" name="name" placeholder="Nombre">
                                        <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('name') }}</div>
                                    </div>
                                </div>
                                
                                <div class="form-group row align-items-center" :class="{'has-danger': errors.has('email'), 'has-success': fields.email && fields.email.valid }">
                                    <label for="email" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-3'">{{ trans('admin.admin-user.columns.email') }}</label>
                                    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-7'">
                                        <input type="text" v-model="form.email" v-validate="'required|email'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('email'), 'form-control-success': fields.email && fields.email.valid}" id="email" name="email" placeholder="{{ trans('admin.admin-user.columns.email') }}">
                                        <div v-if="errors.has('email')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('email') }}</div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>

                </form>

            </profile-edit-profile-form>

        </div>

    </div>

@endsection