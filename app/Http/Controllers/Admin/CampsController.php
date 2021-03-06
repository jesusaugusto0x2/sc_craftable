<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Camp\BulkDestroyCamp;
use App\Http\Requests\Admin\Camp\DestroyCamp;
use App\Http\Requests\Admin\Camp\IndexCamp;
use App\Http\Requests\Admin\Camp\StoreCamp;
use App\Http\Requests\Admin\Camp\UpdateCamp;
use Illuminate\Http\Request;
use App\Models\Camp;
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

use Image;
use App\Models\CampPhoto;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class CampsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexCamp $request
     * @return array|Factory|View
     */
    public function index(IndexCamp $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Camp::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'location', 'entries', 'cost', 'date'],

            // set columns to searchIn
            ['id', 'location']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.camp.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.camp.create');

        return view('admin.camp.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCamp $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreCamp $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Camp
        $camp = Camp::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/camps'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/camps');
    }

    /**
     * Display the specified resource.
     *
     * @param Camp $camp
     * @throws AuthorizationException
     * @return void
     */
    public function show(Camp $camp)
    {
        $this->authorize('admin.camp.show', $camp);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Camp $camp
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Camp $camp)
    {
        $this->authorize('admin.camp.edit', $camp);


        return view('admin.camp.edit', [
            'camp' => $camp,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCamp $request
     * @param Camp $camp
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateCamp $request, Camp $camp)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Camp
        $camp->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/camps'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/camps');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyCamp $request
     * @param Camp $camp
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyCamp $request, Camp $camp)
    {
        $camp->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyCamp $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyCamp $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Camp::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }

    public function viewGallery ($camp_id) {
        try {
            $camp = Camp::find($camp_id);

            return view('admin.camp.gallery')->with('camp', $camp);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function savePhoto (Request $request, $camp_id) {
        try {
            if (!isset($request->photo)) {
                return redirect()->back()->with('notification_error', '¡Debes seleccionar una imagen!');
            }

            $imgrpath = $request->file('photo')->getRealPath();

            $image = Image::make($imgrpath)->stream('png', 90);

            $current_time = Carbon::now()->format('Ymdhis');
            $path = '/camp_' . $camp_id . '/' . $current_time . '.png';

            Storage::disk('images')->put($path, $image);

            CampPhoto::create([
                'camp_id'   =>  $camp_id,
                'url'       =>  config('app.url') . 'images' . $path,
            ]);

            return redirect()->back()->with('notification_success', 'La foto ha sido guardada exitosamente');

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function deletePhoto ($photo_id) {
        try {
            $photo = CampPhoto::find($photo_id);

            $path = str_replace(config('app.url') . 'images', '', $photo->url);

            Storage::disk('images')->delete($path);

            $photo->delete();

            return redirect()->back()->with('notification_success', 'La foto ha sido eliminada exitosamente');
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
