<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function __invoke(){
        return view('contact.index');
    }
}
