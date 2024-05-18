<?php
namespace App\Http\Controllers\Worker\Dish;


use App\Models\DishCategory;
use Illuminate\Http\Request;

class StoreController extends BaseController{
    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'weight' => 'required|numeric',
            'is_active' => 'required|boolean',
            'dish_ingridients' => 'max:255',
            'dish_category_id' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png'    
        ]);

        $this->service->store($data, $request);

        return redirect()->route('worker.dish.index');
    }

    public function addSender(){
        $categories = DishCategory::all();
        return view('worker.dish.add', ['categories'=> $categories]);
    }
}