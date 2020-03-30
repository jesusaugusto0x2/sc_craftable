<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Camp;
use App\Models\CampPayment;

class CampsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param IndexCamp $request
     * @return array|Factory|View
     */
    public function index()
    {
        $data = Camp::nonUserCamps();
        return view('user.camp.index', ['data' => $data]);
    }

    public function myCamps()
    {
        $data = Camp::userCamps();
        return view('user.camp.myCamps', ['data' => $data]);
    }

    public function gallery ($camp_id) {
        try {
            $camp = Camp::find($camp_id);
            return view('user.camp.gallery', [
                'camp' => $camp,
                'returnRoute' => 'camps/index'
            ]);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function myCampsGallery($camp_id) {
        try {
            $camp = Camp::find($camp_id);
            return view('user.camp.gallery', [
                'camp' => $camp,
                'returnRoute' => 'my-camps/'
            ]);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function payment ($camp_id) {
        $user_id = Auth::user()->id;
        try {
            $payment = CampPayment::whereRaw('camp_id = ? AND user_id = ?', [$camp_id, $user_id])
            ->orderBy('id', 'desc')
            ->first();
            return view('user.camp.payment')->with('payment', $payment);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
