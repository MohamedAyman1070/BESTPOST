<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class commentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = User::all()->pluck('id');
        $posts = Post::all()->pluck('id');
        return [
            'body' => fake()->text(rand(10 , 30)) ,
            'user_id' => $users[array_rand($users->toArray())],
            'post_id' => $posts[array_rand($posts->toArray())],
        ];
    }
}
