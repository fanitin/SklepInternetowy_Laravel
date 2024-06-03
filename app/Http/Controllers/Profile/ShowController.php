<?php
namespace App\Http\Controllers\Profile;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class ShowController extends Controller{
    public function __invoke(Order $order){
        return view('profile.order', ['order' => $order]);
    }
}