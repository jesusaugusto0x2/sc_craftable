@extends('brackets/admin-ui::admin.layout.default')

@section('title', 'Información de pago')

<style type="text/css">
    .title {
        color: #4273FA;
        font-size: 18px;
    }

    .card-block {
        border-bottom: 1px solid rgba(207, 216, 220, 0.35);
    }

    .btn {
        margin-right: 10px;
        margin-left: 10px;
    }
</style>

@section('body')
    @include('alerts.flash-messages')
    <div class="col-lg-12">
        @if($notificacion = Session::get('notification_success'))
            <div class="notification notification-success">{{ $notificacion }}</div>
        @endif
        @if($notificacion_error = Session::get('notification_error'))
            <div class="notification notification-error">{{ $notificacion_error }}</div>
        @endif
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header payment-detail-header">
                    <div> {{$payment->camp->location}} - Pago #{{$payment->id}} </div>
                    <div class="{{'payment-status ' . ($payment->validated !== null ? ($payment->validated == 1 ? 'payment-approved' : 'payment-denied') : 'payment-in-process')}}">
                        {{$payment->validated !== null ? ($payment->validated == 1 ? 'aprobado' : 'denegado') : 'por procesar'}}
                    </div>
                </div>

                <div class="card-body">
                    <div class="card-block">
                        <div class="row title">
                            <strong>Datos del Usuario:</strong>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <strong>Nombre: </strong>{{$payment->user->name}}
                            </div>

                            <div class="col">
                                <strong>Correo: </strong>{{$payment->user->email}}
                            </div>

                            <div class="col">
                                <strong>Ingreso: </strong>{{$payment->user->created_at}}
                            </div>
                        </div>
                        <br>
                    </div>

                    <div class="card-block">
                        <div class="row title">
                            <strong>Datos del Pago:</strong>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <strong>Referencia: </strong>{{$payment->reference}}
                            </div>

                            <div class="col">
                                <strong>Método: </strong>{{$payment->method->name}}
                            </div>

                            <div class="col">
                                <strong>Banco: </strong>{{$payment->bank->name}}
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col">
                                <strong>Validado: </strong>
                                @if($payment->validated == 1)
                                    SI
                                @else
                                    NO
                                @endif
                            </div>

                            <div class="col">
                                <strong>Fecha del pago: </strong>{{$payment->date}}
                            </div>

                            <div class="col">
                                <strong>Fecha de registro: </strong>{{$payment->created_at}}
                            </div>
                        </div>
                    </div>
                    @if($payment->photo)
                        <div class="card-block">
                            <div class="row title">
                                <strong>Foto de Referencia:</strong>
                            </div>
                            <br>

                            <div class="d-flex justify-content-center">
                                <img src="{{$payment->photo}}" alt="foto_ref">
                            </div>
                        </div>
                    @endif

                    <br><br>
                    <div class="row">
                        <a style="color:white;" class="btn btn-success" href="{{route('admin/camps/payments', $payment->camp_id)}}">
                            <i class="fa fa-chevron-left"></i> Regresar
                        </a>
                        @if($payment->validated === null)
                            <a style="color:white;" class="btn btn-primary" href="{{route('admin/camps/payment-validate', [$payment->id, 1])}}">
                                <i class="fa fa-check"></i> Validar pago
                            </a>
                            <a style="color:white;" class="btn btn-danger" href="{{route('admin/camps/payment-validate', [$payment->id, 0])}}">
                                <i class="fa fa-times"></i>    Anular pago
                            </a>
                        @endif
                    </div>

                </div>
                <!-- End of card body -->
            </div>
            <!-- End of card -->
        </div>
    </div>

@endsection
