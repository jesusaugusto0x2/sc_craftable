@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.camp_payments_index.actions.index'))

@section('body')

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> {{$camp->location}} - Pagos
                </div>

                <div class="card-body">
                    <div class="card-block">
                        <!-- Formulario -->
                        <form>
                            <div class="row justify-content-md-between">
                                <!-- Input de texto -->
                                <div class="col col-lg-7 col-xl-5 form-group">
                                    <div class="input-group">
                                        <input class="form-control" placeholder="Busca por nombre" />

                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-primary"><i class="fa fa-search"></i>&nbsp; Buscar</button>
                                        </span>
                                    </div>
                                </div>

                                <!-- Select de validos / no validos -->
                                <div class="col-sm-auto form-group ">
                                    <select class="form-control">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                            </div>
                        </form>

                        <!-- Tabla de contenidos -->
                        <table class="table table-hover table-listing">
                            <thead>
                                <tr>
                                    <th>Referencia</th>
                                    <th>Método de Pago</th>
                                    <th>Usuario</th>
                                    <th>Fecha</th>
                                    <th>Verificado</th>
                                    <th></th>
                                </tr>
                                <tr>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($payments as $p)
                                    <tr>
                                        <td>{{$p->reference}}</td>
                                        <td>{{$p->method->name}}</td>
                                        <td>{{$p->user->name}}</td>
                                        <td>{{$p->date}}</td>
                                        <td>
                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                disabled
                                                @if($p->validated == 1)
                                                    checked
                                                @endif
                                            >

                                            <label class="form-check-label" for="enabled">
                                            </label>
                                        </td>

                                        <td>
                                            <div class="row no-gutters">
                                                <div class="col-auto">
                                                    <a class="btn btn-sm btn-spinner btn-info" title="Ver pago" role="button"><i class="fa fa-eye"></i></a>
                                                </div>
                                                <form class="col">
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Eliminar Pago"><i class="fa fa-trash-o"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="row">
                            <div class="col-sm">
                                {{$payments->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
