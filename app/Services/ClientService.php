<?php

namespace App\Services;

use App\Models\User;
use App\Models\ClientProfile;
use App\Repositories\ClientRepository;
use Illuminate\Support\Facades\Hash;

class ClientService
{
    //client service dependencies
    public function __construct(
        private ClientRepository $clients
    ) {}


    //list all clients with their Profiles
    public function listClientsWithProfiles()
    {
        return $this->clients->getAllWithProfile();
    }

    //create a new client user and profile
    public function createClientWithProfile(array $data): User
    {
        $client = $this->clients->createClient(
            [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => 'client',
                'is_active' => true,
            ]
        );

        ClientProfile::create(
            [
                'user_id' => $client->id,
                'company_name' => $data['company_name'] ?? null,
                'contact_person' => $data['contact_person'] ?? null,
                'phone' => $data['phone'] ?? null,

            ]
        );

        return $client;
    }

    //get client +profile by id 
    public function getClientWithProfileById(int $id): User
    {
        return $this->clients->findClientWithProfileOrFailById($id);
    }

    //update client user and profile
    public function updateClient(User $client, array $data): void
    {
        $this->clients->updateClient($client, [
            'name' => $data['name'] ?? $client->name,
            'email' => $data['email'] ?? $client->email,
        ]);

        $client->clientProfile()->updateOrCreate(
            ['user_id' => $client->id],
            [
                'company_name' => $data['company_name'] ?? $client->clientProfile->company_name ?? null,
                'contact_person' => $data['contact_person'] ?? $client->clientProfile->contact_person ?? null,
                'phone' => $data['phone'] ?? $client->clientProfile->phone ?? null,
            ]
        );
    }

    //* Deactivate client (disable login). 
    public function deactivateClient(int $id): void
    {
        $client = $this->clients->findClientOrFailById($id);
        $this->clients->updateClient($client, ['is_active' => false]);
    }

    //reactivate a deactivated client
    public function activateClient(int $id): void
    {
        $client = $this->clients->findClientOrFailById($id);
        $this->clients->updateClient($client, ['is_active' => true]);
    }

    //Reset client password.
    public function resetPassword(int $id, string $password): void
    {
        $client = $this->clients->findClientOrFailById($id);
        $this->clients->updateClient($client, [
            'password' => Hash::make($password),
        ]);
    }

    // Soft delete client.
    public function deleteClient(int $id): void
    {
        $client = $this->clients->findClientOrFailById($id);
        $this->clients->deleteClient($client);
    }
}
