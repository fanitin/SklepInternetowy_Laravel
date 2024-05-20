<?php
namespace App\Http\Controllers\Worker\Payment;


use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;


class SearchController extends Controller{
    public function __invoke(Request $request)
    {
        $searchType = $request->input('searchType');
        $searchTerm = $request->input('searchTerm');
        $payments = Payment::where($searchType, 'like', '%' . $searchTerm . '%')->get();
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