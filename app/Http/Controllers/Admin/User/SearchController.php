<?php
namespace App\Http\Controllers\Admin\User;


use Illuminate\Http\Request;


class SearchController extends BaseController{
    public function __invoke(Request $request)
    {
        $users = $this->service->search($request);
        return response()->json($users);
    }
}