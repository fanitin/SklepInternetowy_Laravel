<?php
namespace App\Http\Controllers\Worker\Category;


use App\Http\Controllers\Controller;
use App\Models\DishCategory;

class DeleteController extends Controller{
    public function __invoke(DishCategory $dish_category){
        $dish_category->delete();
        return redirect()->route('worker.category.index');
    }
}