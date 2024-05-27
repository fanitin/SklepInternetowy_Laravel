<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;

class DeleteAllController extends Controller{
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
        $cart = session()->get('cart', []);
        $cart = [];
        session()->put('cart', $cart);
        $amount = 0;
        $number = 0;
       
        return response()->json(['success' => true, 'amount' => $amount, 'number' => $number]);
    }
}
