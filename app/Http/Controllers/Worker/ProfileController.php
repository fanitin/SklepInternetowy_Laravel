<?php
namespace App\Http\Controllers\Worker;
use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\DishCategory;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller{
    public function __invoke(){
        $worker = Auth::user();
        return view('worker.profile', ['worker'=> $worker]);
    }
}