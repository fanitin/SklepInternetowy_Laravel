<?php
namespace App\Http\Controllers\Worker\Order;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class SearchController extends BaseController{
    public function __invoke(Request $request)
    {
        $orders = $this->service->search($request);
        
        return response()->json($orders);
    }
}