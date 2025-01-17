<?php

namespace Database\Seeders;


use App\Models\Comment;
use App\Models\Post;
use App\Models\React;
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
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::factory(10)->create();

        // beaware that number of posts must be equalt ot number of comments or it will lead to unexpected behaviour
        Post::factory(30)->create();

        Comment::factory(30)->create();

        React::factory(50)->create();
    }
}
