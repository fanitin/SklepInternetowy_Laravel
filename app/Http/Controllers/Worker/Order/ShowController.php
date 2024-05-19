<?php
namespace App\Http\Controllers\Worker\Order;


use App\Models\Order;
use App\Models\Status;
use Illuminate\Http\Request;

class ShowController extends BaseController{
    public function index(Order $order){
        $dishes = $order->dishes;
        $statuses = Status::all();
        return view('worker.order.show', ['order' => $order, 'dishes' => $dishes, 'statuses' => $statuses]);
    }
    public function changeStatus(Order $order, Request $request){
        $this->service->changeStatus($order, $request);

        return redirect()->route('worker.order.index');
    }
}