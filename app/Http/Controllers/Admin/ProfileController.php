<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller{
    public function __invoke(){
        $admin = Auth::user();
        return view('admin.profile', ['admin'=> $admin]);
    }
}