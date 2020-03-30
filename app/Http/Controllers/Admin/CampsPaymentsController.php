<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CampsPayment\BulkDestroyCampsPayment;
use App\Http\Requests\Admin\CampsPayment\DestroyCampsPayment;
use App\Http\Requests\Admin\CampsPayment\IndexCampsPayment;
use App\Http\Requests\Admin\CampsPayment\StoreCampsPayment;
use App\Http\Requests\Admin\CampsPayment\UpdateCampsPayment;
use App\Models\CampsPayment;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CampsPaymentsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexCampsPayment $request
     * @return array|Factory|View
     */
    public function index(IndexCampsPayment $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(CampsPayment::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'reference', 'photo', 'date', 'validated', 'method_id', 'camp_id', 'user_id', 'bank_id'],

            // set columns to searchIn
            ['id', 'reference', 'photo']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.camps-payment.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.camps-payment.create');

        return view('admin.camps-payment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCampsPayment $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreCampsPayment $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the CampsPayment
        $campsPayment = CampsPayment::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/camps-payments'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/camps-payments');
    }

    /**
     * Display the specified resource.
     *
     * @param CampsPayment $campsPayment
     * @throws AuthorizationException
     * @return void
     */
    public function show(CampsPayment $campsPayment)
    {
        $this->authorize('admin.camps-payment.show', $campsPayment);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CampsPayment $campsPayment
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(CampsPayment $campsPayment)
    {
        $this->authorize('admin.camps-payment.edit', $campsPayment);


        return view('admin.camps-payment.edit', [
            'campsPayment' => $campsPayment,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCampsPayment $request
     * @param CampsPayment $campsPayment
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateCampsPayment $request, CampsPayment $campsPayment)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values CampsPayment
        $campsPayment->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/camps-payments'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/camps-payments');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyCampsPayment $request
     * @param CampsPayment $campsPayment
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyCampsPayment $request, CampsPayment $campsPayment)
    {
        $campsPayment->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyCampsPayment $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyCampsPayment $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    CampsPayment::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
