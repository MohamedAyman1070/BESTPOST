<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\react>
 */
class reactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $reactions = ['love' , 'lough' , 'anger' , 'sad' , 'wow'];
        $users = User::all()->pluck('id');
        $posts = Post::all()->pluck('id');
        return [
            'react' => $reactions[array_rand($reactions)] ,
            'reactable_id' => $posts[array_rand($posts->toArray())],
            'reactable_type' => 'App\Models\Post' , 
            'user_id'=>$users[array_rand($users->toArray())],
        ];
    }
}
