<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Models\User;

class ProfileService
{
    public function __construct(private UserRepository $users)
    {
    }

    public function save(User $user): User
    {
        return $this->users->save($user);
    }

    public function deleteUser(User $user): void
    {
        $this->users->delete($user);
    }
}


