<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function viewAny(User $authUser): bool
    {
        return $authUser->can('user.view');
    }

    public function view(User $authUser, User $user): bool
    {
        return $authUser->can('user.view');
    }

    public function create(User $authUser): bool
    {
        return $authUser->can('user.create');
    }

    public function update(User $authUser, User $user): bool
    {
        return $authUser->can('user.edit');
    }

    public function delete(User $authUser, User $user): bool
    {
        // Tidak boleh hapus dirinya sendiri atau super admin
        if ($authUser->id === $user->id || $user->hasRole('super-admin')) {
            return false;
        }
        return $authUser->can('user.delete');
    }

    public function restore(User $authUser, User $user): bool
    {
        return $authUser->can('user.delete');
    }
}
