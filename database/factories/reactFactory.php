<?php

namespace Database\Factories;

use App\Models\Comment;
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
        $comments = Comment::all()->pluck('id');
        $reactable_type = ['App\Models\Post' ,'App\Models\Comment'] ; 
        $reactable_id = [ $posts[array_rand($posts->toArray())] , $comments[array_rand($comments->toArray())]  ];
        return [
            'react' => $reactions[array_rand($reactions)] ,
            'reactable_id' => $reactable_id[ array_rand($reactable_id) ],
            'reactable_type' => $reactable_type[ array_rand($reactable_type) ] , 
            'user_id'=>$users[array_rand($users->toArray())],
        ];
    }
}
