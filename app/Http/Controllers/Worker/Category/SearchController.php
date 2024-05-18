<?php
namespace App\Http\Controllers\Worker\Category;


use App\Http\Controllers\Controller;
use App\Models\DishCategory;
use Illuminate\Http\Request;


class SearchController extends Controller{
    public function __invoke(Request $request)
    {
        $searchType = $request->input('searchType');
        $searchTerm = $request->input('searchTerm');
        $categories = DishCategory::where($searchType, 'like', '%' . $searchTerm . '%')->get();
        return response()->json($categories);
    }
}