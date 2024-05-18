<?php
namespace App\Http\Controllers\Worker\Dish;


use App\Http\Controllers\Controller;
use App\Models\Dish;
use Illuminate\Http\Request;


class SortController extends BaseController{
    public function __invoke(Request $request)
    {
        $dishes = $this->service->sort($request);
    
        return response()->json($dishes);
    }
}