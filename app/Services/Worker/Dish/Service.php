<?php
namespace App\Services\Worker\Dish;

use App\Models\Dish;

class Service{
    public function store($data, $request){
        try {
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $filePath = 'images/dishes/' . $fileName;
            $file->move(public_path('images/dishes'), $fileName);

            $data['image'] = $filePath;
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        Dish::create($data);
    }

    public function edit($dish, $data, $request){
        if(!isset($data['image'])){
            $data['image'] = $dish->image;
        }else{
            try {
                $file = $request->file('image');
                $fileName = $file->getClientOriginalName();
                $filePath = 'images/dishes/' . $fileName;
                $file->move(public_path('images/dishes'), $fileName);
    
                $data['image'] = $filePath;
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }
        
        $dish->update($data);
        return $dish;
    }



    public function search($request){
        $searchType = $request->input('searchType');
        $searchTerm = $request->input('searchTerm');

        $dishes = Dish::join('dish_categories', 'dishes.dish_category_id', '=', 'dish_categories.id')
        ->where($searchType, 'like', '%' . $searchTerm . '%')->get(['dishes.*', 'dish_categories.name as category_name']);

        $dishesWithCategoryName = $dishes->map(function($dish) {
            return [
                'id' => $dish->id,
                'name' => $dish->name,
                'price' => $dish->price,
                'is_active' => $dish->is_active,
                'created_at' => $dish->created_at,
                'category' => $dish->category_name,
            ];
        });
        return $dishesWithCategoryName;
    }


    public function sort($request){
        $sortColumn = $request->input('sortColumn');
        $sortOrder = $request->input('sortOrder');
        
        $dishes = Dish::join('dish_categories', 'dishes.dish_category_id', '=', 'dish_categories.id')
        ->orderBy($sortColumn, $sortOrder)->get(['dishes.*', 'dish_categories.name as category_name']);
        
        $dishesWithCategoryName = $dishes->map(function($dish) {
            return [
                'id' => $dish->id,
                'name' => $dish->name,
                'price' => $dish->price,
                'is_active' => $dish->is_active,
                'created_at' => $dish->created_at,
                'category' => $dish->category_name,
            ];
        });
        return $dishesWithCategoryName;
    }
}