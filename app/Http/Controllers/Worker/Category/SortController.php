<?php
namespace App\Http\Controllers\Worker\Category;


use App\Http\Controllers\Controller;
use App\Models\DishCategory;
use Illuminate\Http\Request;


class SortController extends Controller{
    public function __invoke(Request $request)
    {
        $sortColumn = $request->input('sortColumn');
        $sortOrder = $request->input('sortOrder');
        $categories = DishCategory::orderBy($sortColumn, $sortOrder)->get();
        return response()->json($categories);
    }
}