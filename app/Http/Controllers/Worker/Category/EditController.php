<?php
namespace App\Http\Controllers\Worker\Category;


use App\Models\Dish;
use App\Models\DishCategory;
use Illuminate\Http\Request;

class EditController extends BaseController{
    public function sender(DishCategory $dish_category){
        return view('worker.category.edit', ['dish_category'=> $dish_category]);
    }

    public function edit(DishCategory $dish_category, Request $request){
        $data = $request->validate([
            'name' => 'required|string|max:255'    
        ]);
        
        $dish = $this->service->edit($dish_category, $data);
        return redirect()->route('worker.category.index');
    }
}