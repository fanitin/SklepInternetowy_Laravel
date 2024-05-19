<?php
namespace App\Http\Controllers\Worker;
use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\DishCategory;
use App\Models\Order;

class IndexController extends Controller{
    public function __invoke(){
        $orders = Order::where('status_id', 1)->get()->count();
        $categories = DishCategory::all()->count();
        $dishes = Dish::all()->count();
        return view('worker.index', ['orders'=> $orders, 'categories' => $categories, 'dishes' => $dishes]);
    }
}