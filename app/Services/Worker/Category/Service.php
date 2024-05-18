<?php
namespace App\Services\Worker\Category;

use App\Models\DishCategory;

class Service{
    public function store($data){
        DishCategory::create($data);
    }

    public function edit($dish_category, $data){
        $dish_category->update($data);
    }
}