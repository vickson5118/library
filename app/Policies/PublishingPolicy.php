<?php

namespace App\Policies;

use App\Models\User;

class PublishingPolicy
{
    public function before(User $user): bool {
        if ($user->admin) {
            return true;
        }

        return false;
    }
        
    /**
     * Determine whether the user can view any models.
     */
    public function all(User $user): bool
    {
        return true;
    }
}
