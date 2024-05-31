<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\DishCategory;

class IndexController extends Controller
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
        $cart = session()->get('cart', []);
        $amount = 0;
        foreach($cart as $dish){
            $amount += $dish['price'];
        }
        return view("order.index", [
            'cart' => $cart,
            'amount' => $amount
        ]);
    }
}
