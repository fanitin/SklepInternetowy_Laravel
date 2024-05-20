<?php
namespace App\Http\Controllers\Worker\Payment;


use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;


class SortController extends Controller{
    public function __invoke(Request $request)
    {
        $sortColumn = $request->input('sortColumn');
        $sortOrder = $request->input('sortOrder');
        $payments = Payment::orderBy($sortColumn, $sortOrder)->get();
        $paymentsWith = $payments->map(function($payment) {
            return [
                'id' => $payment->id,
                'service' => $payment->service,
                'amount' => $payment->amount,
                'created_at' => $payment->created_at,
                'order_id' => $payment->order->id
            ];
        });
        return response()->json($paymentsWith);
    }
}