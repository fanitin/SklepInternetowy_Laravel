<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'dish_ingridients', 'price', 'weight', 'is_active', 'image', 'dish_category_id'];

    public function category(){
        return $this->belongsTo(DishCategory::class, 'dish_category_id');
    }
}
