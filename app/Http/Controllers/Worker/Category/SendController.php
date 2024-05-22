<?php
namespace App\Http\Controllers\Worker\Category;


use App\Http\Controllers\Controller;
use App\Models\DishCategory;

class SendController extends Controller{
    public function __invoke(DishCategory $dishCategory){
        $dishes = $dishCategory->dishes;
        return view('worker.category.edit', ['dishCategory'=> $dishCategory, 'dishes' => $dishes]);
    }
}