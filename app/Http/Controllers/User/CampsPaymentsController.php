<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CampsPayment\StoreCampsPayment;
use App\Http\Requests\Admin\CampsPayment\IndexCampsPayment;
use Illuminate\Support\Facades\Auth;
use Brackets\AdminListing\Facades\AdminListing;
use App\Models\Camp;
use App\Models\Bank;
use App\Models\CampPayment;
use App\Models\Method;
use Illuminate\Http\Request;
use Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

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
        $user_id = Auth::user()->id;
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(CampPayment::class)->attachOrdering($request->input('orderBy', 'id'), $request->input('orderDirection', 'desc'))
        ->attachSearch($request->input('search', null), ['reference', 'date'])
        ->attachPagination($request->currentPage)
        ->modifyQuery(function($query) use ($user_id){
            $query->where('user_id', $user_id);
        })
        ->get();

        foreach($data as $d) {
            $d->method;
            $d->camp;
        }

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('user.camps-payment.index', ['data' => $data]);
    }

    public function show ($payment_id) {
        try {
            $payment = CampPayment::find($payment_id);
            //dd($payment);
            return view('user.camps-payment.show')->with('payment', $payment);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */

    public function create(int $camp_id)
    {
        $user_id = Auth::user()->id;
        $path = '/camp_temp/image_temp_' . $camp_id . '_' . $user_id . '.png';
        Storage::disk('images')->delete($path);

        $camp = Camp::find($camp_id);
        $methods = Method::all();
        $banks = Bank::all();
        $payment = json_encode([
            "method_id" => 1,
            "bank_id" => 1,
        ]);

        return view('user.camps-payment.create', [
            'camp' => $camp,
            'methods' => $methods,
            'banks' => $banks,
            'payment' => $payment,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCampsPayment $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(Request $request, int $camp_id)
    {
        $user_id = Auth::user()->id;
        $path = '/camp_temp/image_temp_' . $camp_id . '_' . $user_id . '.png';

        if (Storage::disk('images')->exists($path)) {
            $image = Storage::disk('images')->get($path);

            $current_time = Carbon::now()->format('Ymdhis');
            $path = '/camp_' . $camp_id . '/' . $current_time . '.png';

            Storage::disk('images')->put($path, $image);
            $request['photo'] = config('app.url') . 'images' . $path;
        }
        $request['camp_id'] = $camp_id;
        $request['user_id'] = $user_id;

        CampPayment::create($request->all());

        if ($request->ajax()) {
            \Session::flash('success', 'La inscripción fue realizada exitosamente');
            return ['redirect' => url('camps'), 'message' => 'La inscripcion fue realizada exitosamente'];
        }
        return redirect('camps')->with('notification_success', 'La inscripcion fue realizada exitosamente');

    }

    public function savePhoto(Request $request, int $camp_id)
    {
        if (isset($request->photo)) {
            $user_id = Auth::user()->id;

            $imgrpath = $request->file('photo')->getRealPath();
            $image = Image::make($imgrpath)->stream('png', 90);

            $path = '/camp_temp/image_temp_' . $camp_id . '_' . $user_id . '.png';
            Storage::disk('images')->put($path, $image);

            if(Storage::disk('images')->exists($path)) {
                $some_file = Storage::disk('images')->get($path);
                $path = '/camp_temp/image_temp2.png';
                Storage::disk('images')->put($path, $some_file);
            }
        }
    }

}
