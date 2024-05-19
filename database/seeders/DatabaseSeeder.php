<?php

namespace Database\Seeders;

use App\Models\Dish;
use App\Models\DishCategory;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\Status;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DishCategory::factory(50)->create();
        $dishes = Dish::factory(50)->create();
        User::create([
            'name' => 'admin',
            'email' => 'admin@a.a',
            'password' => bcrypt('qweqweqwe'),
        ]);
        Role::create([
            'name' => 'admin'
        ]);
        Role::create([
            'name' => 'worker'
        ]);
        RoleUser::create([
            'user_id' => 1,
            'role_id' => 1
        ]);
        RoleUser::create([
            'user_id' => 1,
            'role_id' => 2
        ]);
        Status::create([
            'name' => 'złożone'
        ]);
        Status::create([
            'name' => 'w trakcie realizacji'
        ]);
        Status::create([
            'name' => 'wysłane'
        ]);
        Status::create([
            'name' => 'zrealizowane'
        ]);
        Status::create([
            'name' => 'anulowane'
        ]);
        Payment::factory(20)->create();
        $orders = Order::factory(20)->create();

        foreach($orders as $order){
            $dishesIDs = $dishes->random(random_int(1, 10))->pluck('id');
            $order->dishes()->attach($dishesIDs);
        }
    }
}
