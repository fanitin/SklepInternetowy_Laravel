<?php

namespace Database\Seeders;

use App\Models\Dish;
use App\Models\DishCategory;
use App\Models\Role;
use App\Models\RoleUser;
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
        Dish::factory(50)->create();
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
    }
}
