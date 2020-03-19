<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Camp;

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
        $data = Camp::all();
        //dd($data);
        return view('user.camp.index', ['data' => $data]);
    }

    public function gallery ($camp_id) {
        try {
            $camp = Camp::find($camp_id);
            return view('user.camp.gallery')->with('camp', $camp);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
