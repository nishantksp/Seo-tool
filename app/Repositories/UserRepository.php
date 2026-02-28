<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Collection;

class UserRepository
{
    public function getClients(): Collection
    {
        return User::where('role', 'client')->get();
    }

    public function countClients(): int
    {
        return User::where('role', 'client')->count();
    }

    public function save(User $user): User
    {
        $user->save();
        return $user;
    }

    public function create(array $data): User
    {
        return User::create($data);
    }

    public function delete(User $user): void
    {
        $user->delete();
    }
}


