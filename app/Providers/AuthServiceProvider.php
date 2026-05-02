<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;


class AuthServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Super Admin Bypass (Paling atas)
        Gate::before(function ($user, $ability) {
            if ($user->hasRole('super-admin')) {
                return true;
            }
            return null;
        });

        // Contoh custom Gate
        Gate::define('manage-users', function ($user) {
            return $user->can('user.view') || $user->can('user.create');
        });

        Gate::define('publish-post', function ($user, $post) {
            return $user->can('post.publish') ||
                ($user->id === $post->user_id && $user->can('post.edit'));
        });
    }
}
