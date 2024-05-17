<?php
namespace App\Http\Controllers\Worker;
use App\Http\Controllers\Controller;

class IndexController extends Controller{
    public function __invoke(){
        return view('worker.index');
    }
}