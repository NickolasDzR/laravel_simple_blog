<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
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
        Gate::define('create-post', function(User $user) {
            return in_array($user->role, [2, 3]);
        });

        Gate::define('update-post', function (User $user, Post $post) {
            return $user->id === $post->user_id || $user->role === 3;
        });

        Gate::define('delete-post', function (User $user) {
            return $user->role === 3;
        });
    }
}