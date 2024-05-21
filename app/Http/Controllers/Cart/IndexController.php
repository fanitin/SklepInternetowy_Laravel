<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use Illuminate\Http\Request;

class IndexController extends Controller{
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
        $dishes = session()->get("cart", []);
        $amount = 0;
        foreach($dishes as $dish){
            $amount += $dish->price;
        }
        return view("cart.index", ["dishes"=> $dishes, "amount"=> $amount]);
    }
}
