<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">Contenido</li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/camps') }}"><i class="nav-icon icon-puzzle"></i> Campamentos</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/users') }}"><i class="nav-icon icon-book-open"></i> Usuarios</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/banks') }}"><i class="nav-icon icon-diamond"></i> Bancos</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/methods') }}"><i class="nav-icon icon-drop"></i> Métodos de Pago</a></li>
           {{-- Do not delete me :) I'm used for auto-generation menu items --}}

            <li class="d-none nav-title">{{ trans('brackets/admin-ui::admin.sidebar.settings') }}</li>
            <li class="d-none nav-item"><a class="nav-link" href="{{ url('admin/admin-users') }}"><i class="nav-icon icon-user"></i> {{ __('Manage access') }}</a></li>
            <li class="d-none nav-item"><a class="nav-link" href="{{ url('admin/translations') }}"><i class="nav-icon icon-location-pin"></i> {{ __('Translations') }}</a></li>
            {{-- Do not delete me :) I'm also used for auto-generation menu items --}}
            {{--<li class="nav-item"><a class="nav-link" href="{{ url('admin/configuration') }}"><i class="nav-icon icon-settings"></i> {{ __('Configuration') }}</a></li>--}}
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
