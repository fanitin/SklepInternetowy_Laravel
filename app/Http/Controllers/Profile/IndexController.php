<?php
namespace App\Http\Controllers\Profile;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller{
    public function __invoke(){
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->get();
        return view('profile.index', ['user'=> $user, 'orders' => $orders]);
    }
}