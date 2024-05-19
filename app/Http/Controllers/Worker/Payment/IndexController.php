<?php
namespace App\Http\Controllers\Worker\Payment;


use App\Http\Controllers\Controller;
use App\Models\Payment;

class IndexController extends Controller{
    public function __invoke(){
        $payments = Payment::all();
        return view('worker.payment.index', ['payments'=> $payments]);
    }
}