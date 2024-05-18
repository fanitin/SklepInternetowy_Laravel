<?php
namespace App\Http\Controllers\Worker\Dish;


use App\Http\Controllers\Controller;
use App\Models\Dish;

class ShowController extends Controller{
    public function __invoke(Dish $dish){
        return view('worker.dish.show', ['dish' => $dish]);
    }
}