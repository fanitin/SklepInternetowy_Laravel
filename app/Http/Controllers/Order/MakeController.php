<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class MakeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function __invoke(){
        $data = session()->get('dane');

        $payment['service'] = $data['service'];
        $amount = 0;
        $dishes = [];
        foreach(session()->get('cart') as $dish){
            $amount += $dish['price'];
            $dishes[] = $dish['id'];
        }
        $payment['amount'] = $amount;
        $paymentId = Payment::create($payment);

        $order['address'] = $data['address'];
        $order['phone'] = $data['phone'];
        $order['status_id'] = 1;
        $order['payment_id'] = $paymentId->id;
        $order['user_id'] = Auth::user()->id;
        $orderId = Order::create($order);
        $orderId->dishes()->attach($dishes);

        session()->forget('dane');
        session()->forget('cart');
        return view("home.index");
    }
}
