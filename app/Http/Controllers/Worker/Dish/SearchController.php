<?php
namespace App\Http\Controllers\Worker\Dish;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class SearchController extends BaseController{
    public function __invoke(Request $request)
    {
        $dishes = $this->service->search($request);
        
        return response()->json($dishes);
    }
}