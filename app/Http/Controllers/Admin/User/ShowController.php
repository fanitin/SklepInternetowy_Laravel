<?php
namespace App\Http\Controllers\Admin\User;


use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;

class ShowController extends Controller{
    public function __invoke(User $user){
        $roles = Role::all();
        return view('admin.user.show', ['user' => $user, 'roles' => $roles]);
    }
}