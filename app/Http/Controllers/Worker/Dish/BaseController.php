<?php

namespace App\Http\Controllers\Worker\Dish;
use App\Http\Controllers\Controller;
use App\Services\Worker\Dish\Service;

class BaseController extends Controller{
    public $service;
    public function __construct(Service $service){
        $this->service = $service;
    }
}