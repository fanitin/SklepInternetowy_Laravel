<?php

namespace App\Http\Controllers\Worker\Category;
use App\Http\Controllers\Controller;
use App\Services\Worker\Category\Service;

class BaseController extends Controller{
    public $service;
    public function __construct(Service $service){
        $this->service = $service;
    }
}