<?php
namespace App\Http\Controllers\Worker\Category;


use App\Http\Controllers\Controller;
use App\Models\DishCategory;
use Illuminate\Http\Request;

class EditController extends BaseController{
    public function __invoke(DishCategory $dishCategory, Request $request){
        $data = $request->validate([
            'name' => 'required|string|max:255'    
        ]);
        
        $this->service->edit($dishCategory, $data);
        return redirect()->route('worker.category.index');
    }
}