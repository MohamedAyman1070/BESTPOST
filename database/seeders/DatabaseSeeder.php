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

        $users = User::all()->pluck('id');

        Post::factory(50)->create();

        $posts = Post::all()->pluck('id');

        Comment::factory(50)->create();


        React::factory(100)->create();


        // React::factory()->create([
        //     'reactable_id' => $posts[array_rand($posts->toArray())],
        //     'reactable_type' => 'App\Models\Post' , 
        //     'user_id'=>$users[array_rand($users->toArray())],
        // ]) ; 



    }
}
