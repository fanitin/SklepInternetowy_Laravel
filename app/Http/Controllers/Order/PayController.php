<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;

class PayController extends Controller
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
        $data = request()->all();
        session()->put('dane', $data);
        if($data['service'] == 'przy_odbiorze'){
            return redirect()->route('order.make');
        }else{
            return view("order.pay", ['service' => $data['service']]);
        }
    }
}
