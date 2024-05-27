<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeleteChosenController extends Controller{
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
        $selectedIdsJson = $request->input('selectedIds');
        $selectedIds = json_decode($selectedIdsJson, true);

        $cart = session()->get('cart', []);
        foreach ($selectedIds as $id) {
            unset($cart[$id]);
        }
        $amount = 0;
        foreach ($cart as $dish) {
            $amount += $dish->price;
        }
        $number = count($cart);
        session()->put('cart', $cart);

        return response()->json(['success' => true, 'amount' => $amount, 'number' => $number]);
    }
}
