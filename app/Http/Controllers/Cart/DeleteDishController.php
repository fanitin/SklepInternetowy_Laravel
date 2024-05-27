<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeleteDishController extends Controller{
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
    public function __invoke(Request $request){
        $cart = session()->get('cart', []);
        $id = $request->input('cart_id');
        unset($cart[$id]);
        session()->put('cart', $cart);
        $amount = 0;
        foreach($cart as $dish){
            $amount += $dish->price;
        }
        $number = count($cart);
        return response()->json(['success' => true, 'amount' => $amount, 'number' => $number]);
    }
}
