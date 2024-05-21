<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use Illuminate\Http\Request;

class AddController extends Controller
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
    public function __invoke(Request $request){
        $dish = Dish::find($request->dish_id);
        
        if (!$dish) {
            return response()->json(['error' => 'Podany posiłek nie istnieje'], 404);
        }

        $cart = session()->get('cart', []);
        $cart[] = $dish;
        session()->put('cart', $cart);

        return response()->json(['message' => 'Dodano do zamówienia.', 'cartCount' => count($cart)]);
    }
}
