<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DishCategory extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function dishes(){
        return $this->hasMany(Dish::class);
    }

    public function firstDish(){
        return $this->dishes()->first();
    }


    public function getRouteKeyName(){
        return 'name';
    }
}
