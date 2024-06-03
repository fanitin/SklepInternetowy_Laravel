<?php
namespace App\Services\Admin\User;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Service{

    public function edit($data, $user){
        $user = User::find($user->id);
        if($user->hasRole(['admin'])) {
            $data[] = Role::where('name', 'admin')->first()->id;
        }
        $user->roles()->sync($data);
        $upd = array();
        $upd['editor_id'] = Auth::user()->id;
        $user->update($upd);
        $user->touch();
    }



    public function search($request){
        $query = User::with('roles');

        if ($request->filled('searchTerm')) {
            $term = $request->input('searchTerm');
            $type = $request->input('searchType');
            $query->where("users.$type", 'like', '%' . $term . '%');
        }

        if ($request->filled('roles')) {
            $roles = explode(',', $request->input('roles'));
            $query->whereHas('roles', function ($q) use ($roles) {
                $q->whereIn('roles.id', $roles);
            });
        }

        $users = $query->get();
        return $users;
    }


    public function sort($request){
        $query = User::with('roles');

        if ($request->filled('sortColumn') && $request->filled('sortOrder')) {
            $query->orderBy($request->input('sortColumn'), $request->input('sortOrder'));
        }

        if ($request->filled('roles')) {
            $roles = explode(',', $request->input('roles'));
            $query->whereHas('roles', function ($q) use ($roles) {
                $q->whereIn('roles.id', $roles);
            });
        }
        $users = $query->get();
        return $users;
    }
}