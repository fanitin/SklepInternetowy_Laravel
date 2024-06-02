<?php
namespace App\Http\Controllers\Admin\User;


use App\Models\User;
use Illuminate\Http\Request;

class EditController extends BaseController{
    public function __invoke(Request $request, User $user){
        $data = $request->roles;
        
        $this->service->edit($data, $user);
        return redirect()->route('admin.user.show', $user->id);
    }
}