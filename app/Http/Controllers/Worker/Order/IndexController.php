<?php
namespace App\Http\Controllers\Worker\Order;


use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Status;

class IndexController extends Controller{
    public function __invoke(){
        $orders = Order::orderBy('status_id', 'asc')->get();
        $statuses = Status::all();
        return view('worker.order.index', ['orders' => $orders, 'statuses' => $statuses]);
    }
}