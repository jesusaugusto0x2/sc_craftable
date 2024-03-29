@extends('user.layout.layout')

@section('title', 'Pagos')

@section('body')

    <camps-payment-listing
        :data="{{ $data->toJson() }}"
        :url="'{{ url('payments') }}'"
        inline-template>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Pagos
                    </div>
                    <div class="card-body" v-cloak>
                        <div class="card-block">
                            <form @submit.prevent="">
                                <div class="row justify-content-md-between">
                                    <div class="col col-lg-7 col-xl-5 form-group">
                                        <div class="input-group">
                                            <input class="form-control" placeholder="referencia o fecha" v-model="search" @keyup.enter="filter('search', $event.target.value)" />
                                            <span class="input-group-append">
                                                <button type="button" class="btn btn-primary" @click="filter('search', search)"><i class="fa fa-search"></i>&nbsp; Buscar</button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-auto form-group ">
                                        <select class="form-control" v-model="pagination.state.per_page">

                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                </div>
                            </form>

                            <div class="table-responsive">
                                <table class="table table-hover table-wrapper">
                                    <thead>
                                        <tr>

                                            <th is='sortable' :column="'reference'">Referencia</th>
                                            <th is='sortable' :column="'date'">Fecha</th>
                                            <th :column="'camp_id'">Campamento</th>
                                            <th :column="'method_id'">Método de Pago</th>
                                            <th is='sortable' :column="'validated'">Estado</th>

                                            <th></th>
                                        </tr>
                                        <tr v-show="(clickedBulkItemsCount > 0) || isClickedAll">
                                            <td class="bg-bulk-info d-table-cell text-center" colspan="11">
                                                <span class="align-middle font-weight-light text-dark">{{ trans('brackets/admin-ui::admin.listing.selected_items') }} @{{ clickedBulkItemsCount }}.  <a href="#" class="text-primary" @click="onBulkItemsClickedAll('/admin/camps-payments')" v-if="(clickedBulkItemsCount < pagination.state.total)"> <i class="fa" :class="bulkCheckingAllLoader ? 'fa-spinner' : ''"></i> {{ trans('brackets/admin-ui::admin.listing.check_all_items') }} @{{ pagination.state.total }}</a> <span class="text-primary">|</span> <a
                                                            href="#" class="text-primary" @click="onBulkItemsClickedAllUncheck()">{{ trans('brackets/admin-ui::admin.listing.uncheck_all_items') }}</a>  </span>

                                                <span class="pull-right pr-2">
                                                    <button class="btn btn-sm btn-danger pr-3 pl-3" @click="bulkDelete('/admin/camps-payments/bulk-destroy')">{{ trans('brackets/admin-ui::admin.btn.delete') }}</button>
                                                </span>

                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, index) in collection" :key="item.id" :class="bulkItems[item.id] ? 'bg-bulk' : ''">

                                            <td>@{{ item.reference }}</td>
                                            <td>@{{ item.date | datetime }}</td>
                                            <td>@{{ item.camp.location }}</td>
                                            <td>@{{ item.method.name }}</td>
                                            <td>
                                                <div :class="'payment-status ' + (item.validated != null ? (item.validated == 1 ? 'payment-approved' : 'payment-denied') : 'payment-in-process')">
                                                    @{{ item.validated != null ? (item.validated == 1 ? 'aprobado' : 'denegado') : 'En proceso' }}
                                                </div>
                                            </td>

                                            <td>
                                                <div class="row no-gutters">
                                                    <div class="col-auto">
                                                    <a class="btn btn-sm btn-spinner btn-info" :href="'payments/' + item.id" title="Ver" role="button"><i class="fa fa-eye"></i></a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="row" v-if="pagination.state.total > 0">
                                <div class="col-sm">
                                    <span class="pagination-caption"></span>
                                </div>
                                <div class="col-sm-auto">
                                    <pagination></pagination>
                                </div>
                            </div>

                            <div class="no-items-found" v-if="!collection.length > 0">
                                <i class="icon-magnifier"></i>
                                <h3>{{ trans('brackets/admin-ui::admin.index.no_items') }}</h3>
                                <p>{{ trans('brackets/admin-ui::admin.index.try_changing_items') }}</p>
                                <a class="btn btn-primary btn-spinner" href="{{ url('admin/camps-payments/create') }}" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('admin.camps-payment.actions.create') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </camps-payment-listing>

@endsection
