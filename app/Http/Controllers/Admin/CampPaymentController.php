<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brackets\AdminListing\Facades\AdminListing;

use App\Models\Camp;
use App\Models\CampPayment;

class CampPaymentController extends Controller
{
    /**
     * Return a view with the listing of all payments made inside a camp
     */
    public function getPayments ($camp_id) {
        try {
            $camp = Camp::find($camp_id);

            $payments = CampPayment::where('camp_id', $camp_id)->paginate(10);

            return view('admin.camp.payments.index', [
                'camp'  =>  $camp,
                'payments'  =>  $payments
            ]);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

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
     * Changes the status of a payment just by switching boolean
     */
    public function validatePayment ($payment_id) {
        try {
            $payment = CampPayment::find($payment_id);

            $payment->validated = !$payment->validated;
            $payment->save();

            $status = $payment->validated == 1 ? 'validado' : 'invalidado';

            return redirect()->back()->with('notification_success', 'El pago ha sido ' . $status);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
