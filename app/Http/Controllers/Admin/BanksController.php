<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Bank\BulkDestroyBank;
use App\Http\Requests\Admin\Bank\DestroyBank;
use App\Http\Requests\Admin\Bank\IndexBank;
use App\Http\Requests\Admin\Bank\StoreBank;
use App\Http\Requests\Admin\Bank\UpdateBank;
use App\Models\Bank;
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

class BanksController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexBank $request
     * @return array|Factory|View
     */
    public function index(IndexBank $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Bank::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name'],

            // set columns to searchIn
            ['id', 'name']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.bank.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.bank.create');

        return view('admin.bank.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBank $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreBank $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Bank
        $bank = Bank::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/banks'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/banks');
    }

    /**
     * Display the specified resource.
     *
     * @param Bank $bank
     * @throws AuthorizationException
     * @return void
     */
    public function show(Bank $bank)
    {
        $this->authorize('admin.bank.show', $bank);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Bank $bank
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Bank $bank)
    {
        $this->authorize('admin.bank.edit', $bank);


        return view('admin.bank.edit', [
            'bank' => $bank,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBank $request
     * @param Bank $bank
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateBank $request, Bank $bank)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Bank
        $bank->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/banks'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/banks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyBank $request
     * @param Bank $bank
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyBank $request, Bank $bank)
    {
        $bank->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyBank $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyBank $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Bank::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
