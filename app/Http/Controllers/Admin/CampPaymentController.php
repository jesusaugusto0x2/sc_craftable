<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\CampsPayment\IndexCampsPayment;
use Brackets\AdminListing\Facades\AdminListing;
use App\Models\Camp;
use App\Models\CampPayment;

class CampPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param IndexCampsPayment $request
     * @return array|Factory|View
     */
    public function getPayments(IndexCampsPayment $request, $camp_id)
    {
        // create and AdminListing instance for a specific model and
        $camp = Camp::find($camp_id);

        $data = AdminListing::create(CampPayment::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'reference', 'date', 'validated', 'method_id', 'camp_id', 'user_id', 'bank_id'],

            // set columns to searchIn
            ['id', 'reference', 'date'],

            
            function($query) use ($request, $camp_id){
                $query->where('camp_id', $camp_id)->orderBy($request->input('orderBy', 'id'),  $request->input('orderDirection', 'desc'));
            }
        );

        foreach($data as $d) {
            $d->method;
            $d->user;
        }

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data, 'camp' => $camp];
        }

        return view('admin.camp.payments.index2', ['data' => $data, 'camp' => $camp]);
    }

    /**
     * Return a view with the listing of all payments made inside a camp
     */
   /* public function getPayments ($camp_id) {
        try {
            $camp = Camp::find($camp_id);

            $payments = CampPayment::where('camp_id', $camp_id)->paginate(10);

            return view('admin.camp.payments.index2', [
                'camp'  =>  $camp,
                'payments'  =>  $payments
            ]);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }*/

    /**
     * Retrieves all info about an specific payment
     */
    public function viewPayment ($payment_id) {
        try {
            $payment = CampPayment::find($payment_id);

            return view('admin.camp.payments.info', [
                'payment'  =>  $payment
            ]);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    
    /**
     * Changes the status of a payment according to variable 'status'
     */
    public function validatePayment ($payment_id, $status) {
        try {
            $payment = CampPayment::find($payment_id);

            $payment->validated = $status;
            $payment->save();

            $status = $payment->validated == 1 ? 'validado' : 'invalidado';

            return redirect()->back()->with('success', 'El pago ha sido ' . $status);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
