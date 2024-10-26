<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $color = array();
        $color[] = rand(50, 255) . ',';
        $color[] = rand(50, 255) . ',';
        $color[] = rand(50, 255);
        $email = fake()->unique()->safeEmail();
        $email_segment = substr($email, 0, strpos($email, '@'));
        if (strlen($email_segment) > 12) {
            $email_segment = substr($email_segment, 0, 11);
        }
        $rand_arr = [rand(0, 9), rand(0, 9), rand(0, 9)];
        $userTag = '@' . strtoupper($email_segment) . implode($rand_arr);
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'userTag' => $userTag,
            'background_color' => implode($color)
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
