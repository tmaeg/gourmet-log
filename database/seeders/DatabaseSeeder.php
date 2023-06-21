<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Restaurant;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(2)->create();
        foreach ($users as $user) {
            $categories = Category::factory(10)->for($user)->count(10)->create();
            for($i = 0; $i < 10; $i++) {
                Restaurant::factory()->for($user)->hasAttached($categories->random(rand(1, 3)))->create();
            }
        }
    }
}
