<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    protected $policies = [
        User::class => UserPolicy::class,
        // ...
    ];

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
        //
    }
}

// contoh penggunaan

// public function index()
// {
//     $this->authorize('viewAny', User::class);
//     // ...
// }

// public function destroy(User $user)
// {
//     $this->authorize('delete', $user);
//     // ...
// }