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
        $users = User::factory(2)->sequence(
            ['email' => 'user1@example.org'],
            ['email' => 'user2@example.org'],
        )->create();
        foreach ($users as $user) {
            $categories = Category::factory(20)->for($user)->create();
            for($i = 0; $i < 20; $i++) {
                Restaurant::factory()->for($user)->hasAttached($categories->random(rand(1, 3)))->create();
            }
        }
    }
}
