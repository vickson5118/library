<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{

    public function before(User $user): bool {
        if ($user->admin) {
            return true;
        }

        return false;
    }

    public function all(User $user): bool
    {
        return true;
    }
}
