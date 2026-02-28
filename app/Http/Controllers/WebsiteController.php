<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\WebsiteService;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function __construct(private WebsiteService $service)
    {
    }

    public function index()
    {
        $websites = $this->service->listAdminWebsites();
        return view('admin.websites.index', compact('websites'));
    }

    public function create()
    {
        $clients = $this->service->listClients();
        return view('admin.websites.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'domain' => 'required',
            'user_id' => 'required',
        ]);

        $this->service->createWebsite($request->all());

        return redirect('/admin/websites')->with('success','Website Added');
    }


    public function edit($id)
    {
        $website = $this->service->getWebsiteForEdit($id);
        $clients = $this->service->listClients();
        $countries = $this->service->getCountries();
        $niches = $this->service->getNiches();

        return view('admin.websites.edit', compact('website', 'clients', 'countries', 'niches'));
    }

    public function update(WebsiteUpdateRequest $request, $id)
    {
        $this->service->updateWebsite($id, $request->validated());

        return redirect('/admin/websites')->with('success','Website Updated');
    }

    public function destroy($id)
    {
        $this->service->deleteWebsite($id);

        return redirect('/admin/websites')->with('success','Website Deleted');
    }


}


