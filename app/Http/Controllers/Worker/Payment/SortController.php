<?php
namespace App\Http\Controllers\Worker\Payment;


use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;


class SortController extends Controller{
    public function __invoke(Request $request)
    {
        $sortColumn = $request->input('sortColumn');
        $sortOrder = $request->input('sortOrder');
        $payments = Payment::orderBy($sortColumn, $sortOrder)->get();
        return response()->json($payments);
    }
}