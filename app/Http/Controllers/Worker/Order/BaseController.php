<?php

namespace App\Http\Controllers\Worker\Order;
use App\Http\Controllers\Controller;
use App\Services\Worker\Order\Service;

class BaseController extends Controller{
    public $service;
    public function __construct(Service $service){
        $this->service = $service;
    }
}