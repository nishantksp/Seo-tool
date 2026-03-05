<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ClientService;

class ClientController extends Controller
{
    // Inject the client service.
    public function __construct(private ClientService $service)
    {

    }

    //List all clients.
    public function index(){
        $clients=$this->service->listClientsWithProfiles();
        return view('admin.clients.index',compact('clients'));
    }

    //show create client form
    public function create(){
        return view('admin.clients.create');
    }
    //store a new client plus profile
    public function store(Request $request){
        $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','email','unique:users,email'],
            'password' => ['required','string','min:8'],
            'company_name' => ['required','string','max:255'],
            'contact_person' => ['nullable','string','max:255'],
            'phone' => ['nullable','string','max:20'],
        ]);

        $this->service->createClientWithProfile($request->all());

        return redirect('/admin/clients')->with('success','Client Added');
    }

    //show edit form
    public function edit($id)
    {
        $client= $this->service->getClientWithProfileById($id);
        return view('admin.clients.edit',compact('client'));
    }


    //update client and profile
    public function update(Request $request, $id){
        $client=$this->service->getClientWithProfileById($id);
        $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','email','unique:users,email,'.$client->id],
            'company_name' => ['required','string','max:255'],
            'contact_person' => ['nullable','string','max:255'],
            'phone' => ['nullable','string','max:50'],
        ]);

        $this->service->updateClient($client, $request->all());

        return redirect('/admin/clients')->with('success','Client Updated');
    }

    //deactivate client
    public function deactivate($id){
        $this->service->deactivateClient((int)$id);
        return back()->with('success','Client Deactivated');
    }

    //activate client
    public function activate($id){
        $this->service->activateClient((int)$id);
        return back()->with('success','Client Activated');
    }

    //reset client password
    public function resetPassword(Request $request, $id){
        $request->validate([
            'password' => ['required','string','min:8','confirmed'],
        ]);

        $this->service->resetPassword((int)$id, $request->input('password'));
        return back()->with('success','Password Reset');
    }

    //soft delete client

    public function destroy($id){
        $this->service->deleteClient((int)$id);
        return back()->with('success','Client Deleted');
    }
}
