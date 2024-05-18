<?php
namespace App\Http\Controllers\Worker\Dish;


use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\DishCategory;
use Illuminate\Http\Request;

class EditController extends BaseController{
    public function sender(Dish $dish){
        $categories = DishCategory::all();
        return view('worker.dish.edit', ['dish'=> $dish, 'categories'=> $categories]);
    }

    public function edit(Dish $dish, Request $request){
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'weight' => 'required|numeric',
            'is_active' => 'required|boolean',
            'dish_ingridients' => 'max:255',
            'dish_category_id' => 'required',
            'image' => 'mimes:jpeg,jpg,png'     
        ]);
        
        $dish = $this->service->edit($dish, $data, $request);
        return redirect()->route('worker.dish.show', $dish->id);
    }
}