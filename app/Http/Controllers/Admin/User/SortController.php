<?php
namespace App\Http\Controllers\Admin\User;


use Illuminate\Http\Request;


class SortController extends BaseController{
    public function __invoke(Request $request)
    {
        $users = $this->service->sort($request);
    
        return response()->json($users);
    }
}