<?php
namespace App\Http\Controllers\Worker\Dish;


use App\Http\Controllers\Controller;
use App\Models\Dish;

class IndexController extends Controller{
    public function __invoke(){
        $dishes = Dish::all();
        return view('worker.dish.index', ['dishes'=> $dishes]);
    }
}