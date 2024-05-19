<?php
namespace App\Http\Controllers\Worker\Payment;


use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;


class SearchController extends Controller{
    public function __invoke(Request $request)
    {
        $searchType = $request->input('searchType');
        $searchTerm = $request->input('searchTerm');
        $payments = Payment::where($searchType, 'like', '%' . $searchTerm . '%')->get();
        return response()->json($payments);
    }
}