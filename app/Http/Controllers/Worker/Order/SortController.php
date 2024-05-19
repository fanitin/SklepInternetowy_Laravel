<?php
namespace App\Http\Controllers\Worker\Order;


use Illuminate\Http\Request;


class SortController extends BaseController{
    public function __invoke(Request $request)
    {
        $orders = $this->service->sort($request);
    
        return response()->json($orders);
    }
}