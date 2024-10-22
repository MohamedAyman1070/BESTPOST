<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('update-delete-post', function (User $user, $post_user_id) {
            return $user->id === $post_user_id;
        });
        Gate::define('update-delete-comment', function (User $user, $comment_user_id) {
            return $user->id === $comment_user_id;
        });
        Gate::define('follow', function (User $user, int $user_to_follow) {
            return $user->following->find($user_to_follow) == null;
        });
        Gate::define('unfollow', function (User $user, int $user_to_follow) {
            return $user->following->find($user_to_follow) != null;
        });
    }
}
