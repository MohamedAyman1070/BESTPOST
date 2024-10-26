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

        Post::factory(30)->create();

        Comment::factory(80)->create();

        React::factory(300)->create();
    }
}
