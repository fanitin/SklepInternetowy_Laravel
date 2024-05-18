<?php
namespace App\Http\Controllers\Worker\Category;


use App\Models\DishCategory;
use Illuminate\Http\Request;

class StoreController extends BaseController{
    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required|string|max:255', 
        ]);

        $this->service->store($data);

        return redirect()->route('worker.category.index');
    }

    public function addSender(){
        return view('worker.category.add');
    }
}