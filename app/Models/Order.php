<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['status_id', 'processed_by_user_id', 'address', 'payment_id', 'user_id', 'phone'];
    public function dishes(){
        return $this->belongsToMany(Dish::class, 'dish_orders', 'order_id', 'dish_id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function status(){
        return $this->belongsTo(Status::class, 'status_id');
    }
    public function payment(){
        return $this->belongsTo(Payment::class, 'payment_id');
    }
    public function processedByUser(){
        return $this->belongsTo(User::class, 'processed_by_user_id');
    }
}
