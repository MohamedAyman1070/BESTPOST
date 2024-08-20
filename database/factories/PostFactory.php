<?php

namespace Database\Factories;

use App\Models\User;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = User::all()->pluck('id') ;

        $cloud_assets = collect(Cloudinary::admin()->assets());
        $resources = $cloud_assets['resources'];
        $img_url = $resources[array_rand($resources)]['secure_url'] ;
        $img_id = $resources[array_rand($resources)]['public_id'];
        // /img/$img_url/img_id/$img_id"
        $text = "/img/$img_url/img_id/$img_id\n";
        $text .= fake()->text(rand(800 , 2000));
        return [
            "body" =>  $text,
            "user_id" => $users[array_rand($users->toArray())] ,
        ];
    }
}
