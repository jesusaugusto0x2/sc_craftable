
@extends('brackets/admin-ui::admin.layout.master')

@section('header')
    @include('user.layout.header')
@endsection

@section('content')

    <div class="app-body">

        @include('user.layout.sidebar')

        <main class="main">

            <div class="container-fluid" id="app" :class="{'loading': loading}">
                <div class="modals">
                    <v-dialog/>
                </div>
                <div>
                    <notifications position="bottom right" :duration="2000" />
                </div>
                @include('alerts.flash-messages')
                @yield('body')
            </div>
        </main>
    </div>

    <footer class="app-footer">
        <div class="container-fluid">
            <div class="container-xl">
            <span class="pull-right">

            </span>
            </div>
        </div>
    </footer>
@endsection

@section('bottom-scripts')
    @parent
@endsection
