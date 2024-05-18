<?php
namespace App\Http\Controllers\Worker\Dish;


use App\Http\Controllers\Controller;
use App\Models\Dish;

class DeleteController extends Controller{
    public function __invoke(Dish $dish){
        $dish->delete();
        return redirect()->route('worker.dish.index');
    }
}