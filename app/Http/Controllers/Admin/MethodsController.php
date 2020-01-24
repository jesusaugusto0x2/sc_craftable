<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Method\BulkDestroyMethod;
use App\Http\Requests\Admin\Method\DestroyMethod;
use App\Http\Requests\Admin\Method\IndexMethod;
use App\Http\Requests\Admin\Method\StoreMethod;
use App\Http\Requests\Admin\Method\UpdateMethod;
use App\Models\Method;
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

class MethodsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexMethod $request
     * @return array|Factory|View
     */
    public function index(IndexMethod $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Method::class)->processRequestAndGet(
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

        return view('admin.method.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.method.create');

        return view('admin.method.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMethod $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreMethod $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Method
        $method = Method::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/methods'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/methods');
    }

    /**
     * Display the specified resource.
     *
     * @param Method $method
     * @throws AuthorizationException
     * @return void
     */
    public function show(Method $method)
    {
        $this->authorize('admin.method.show', $method);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Method $method
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Method $method)
    {
        $this->authorize('admin.method.edit', $method);


        return view('admin.method.edit', [
            'method' => $method,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateMethod $request
     * @param Method $method
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateMethod $request, Method $method)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Method
        $method->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/methods'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/methods');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyMethod $request
     * @param Method $method
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyMethod $request, Method $method)
    {
        $method->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyMethod $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyMethod $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Method::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
