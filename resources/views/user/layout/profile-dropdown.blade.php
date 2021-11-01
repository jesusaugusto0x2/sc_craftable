<div class="dropdown-menu dropdown-menu-right">
    <div class="dropdown-header text-center"><strong>{{ trans('brackets/admin-ui::admin.profile_dropdown.account') }}</strong></div>
    <a href="{{ url('user/profile') }}" class="dropdown-item"><i class="fa fa-user"></i> Perfil</a>
    <a href="{{ url('user/password') }}" class="dropdown-item"><i class="fa fa-key"></i> Contraseña</a>
    {{-- Do not delete me :) I'm used for auto-generation menu items --}}
    <a href="{{ route('logout') }}" class="dropdown-item"><i class="fa fa-lock"></i> Cerrar sesión</a>
</div>