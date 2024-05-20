<?php
namespace App\Services\Worker\Order;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;



class Service{
    public function changeStatus($order, $request){
        $data = $request->validate([
            'status_id' => 'required'
        ]);
        $data['processed_by_user_id'] = Auth::user()->id;
        $order->update($data);
    }


    public function sort($request){
        $sortColumn = $request->input('sortColumn');
        $sortOrder = $request->input('sortOrder');

        $orders = Order::join('payments', 'orders.payment_id', '=', 'payments.id')
        ->join('statuses', 'orders.status_id', '=', 'statuses.id')
        ->orderBy($sortColumn, $sortOrder)->get(['orders.*', 'payments.amount as amount', 'statuses.name as status']);

        $ordersWith = $orders->map(function($order) {
            return [
                'id' => $order->id,
                'address' => $order->address,
                'phone' => $order->phone,
                'amount' => $order->amount,
                'created_at' => $order->created_at,
                'payment_id' => $order->payment_id,
                'status' => $order->status,
                'processed_by_user_id' => $order->processed_by_user_id,
                'orderCount' => $order->dishes->count()
            ];
        });
        return $ordersWith;
        
    }

    public function search($request){
        $searchType = $request->input('searchType');
        $searchTerm = $request->input('searchTerm');

        $orders = Order::join('payments', 'orders.payment_id', '=', 'payments.id')
        ->join('statuses', 'orders.status_id', '=', 'statuses.id')
        ->where($searchType, 'like', '%' . $searchTerm . '%')->get(['orders.*', 'payments.amount as amount', 'statuses.name as status']);

        $ordersWith = $orders->map(function($order) {
            return [
                'id' => $order->id,
                'address' => $order->address,
                'phone' => $order->phone,
                'amount' => $order->amount,
                'created_at' => $order->created_at,
                'payment_id' => $order->payment_id,
                'status' => $order->status,
                'processed_by_user_id' => $order->processed_by_user_id,
                'orderCount' => $order->dishes->count()
            ];
        });
        return $ordersWith;
    }
}