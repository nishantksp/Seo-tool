<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;


//this repository handles all database operations related to client users and their profiles and handled by admin
class ClientRepository{

    //get all clients
    public function getAllWithProfile():Collection
    {
        return User::where('role','client')
        ->with('clientProfile')
        ->latest()
        ->get();
    }

    //find client by id
    public function findClientOrFailById(int $id):User{
        return User::where('role','client')->findOrFail($id);
    }

    //find a client by id with profile
    public function findClientWithProfileOrFailById(int $id):User{
        return User::where('role','client')
        ->with('clientProfile')
        ->findOrFail($id);
    }

    //create a new User with role client 
    public function createClient(array $data):User{
        return User::create($data);
    }

    //update A client user
    public function updateClient(User $client, array $data):User{
        $client->update($data);
        return $client;
    }

    //soft deletes a client User
    public function deleteClient(User $client):void{
        $client->delete();
    }
}