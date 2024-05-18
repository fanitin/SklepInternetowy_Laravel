<?php
namespace App\Http\Controllers\Worker\Dish;


use App\Http\Controllers\Controller;
use App\Models\Dish;
use Illuminate\Http\Request;


class SortController extends Controller{
    public function __invoke(Request $request)
    {
        $sortColumn = $request->input('sortColumn');
        $sortOrder = $request->input('sortOrder');
        if($sortColumn == 'dish_categories.name'){
            $dishes = Dish::join('dish_categories', 'dishes.dish_category_id', '=', 'dish_categories.id')
            ->orderBy($sortColumn, $sortOrder)->get(['dishes.*', 'dish_categories.name as category_name']);
        }else{
            $dishes = Dish::join('dish_categories', 'dishes.dish_category_id', '=', 'dish_categories.id')
            ->orderBy('dishes.'.$sortColumn, $sortOrder)->get(['dishes.*', 'dish_categories.name as category_name']);
        }
        $dishesWithCategoryName = $dishes->map(function($dish) {
            return [
                'id' => $dish->id,
                'name' => $dish->name,
                'price' => $dish->price,
                'is_active' => $dish->is_active,
                'created_at' => $dish->created_at,
                'category' => $dish->category_name,
            ];
        });
    
        return response()->json($dishesWithCategoryName);
    }
}