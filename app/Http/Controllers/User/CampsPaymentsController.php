<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CampsPayment\StoreCampsPayment;
use Illuminate\Support\Facades\Auth;
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
