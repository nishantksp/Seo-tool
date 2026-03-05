<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\WebsiteStoreRequest;
use App\Http\Requests\WebsiteUpdateRequest;
use App\Services\WebsiteService;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    /**
     * Inject the website service.
     */
    public function __construct(private WebsiteService $service)
    {
    }

    /**
     * List admin websites with filters for country/niche.
     */
    public function index(Request $request)
    {   $filters=[
        'status'=>$request->query('status'),
        'client_id'=>$request->query('client_id'),
        'search'=>$request->query('search'),
    ];
        $countries= $this->service->getCountries();
        $websites = $this->service->listAdminWebsites($filters, 15);
        $clients = $this->service->listClients();
        return view('admin.websites.index', compact('websites','countries','clients','filters'));
    }

    /**
     * Show create website form.
     */
    public function create()
    {
        $clients = $this->service->listClients();
        $countries= $this->service->getCountries();
        $niches= $this->service->getNiches();
        return view('admin.websites.create', compact('clients','countries','niches'));
    }

    /**
     * Store a new website.
     */
    public function store(WebsiteStoreRequest $request)
    {
        $this->service->createWebsite($request->validated());

        return redirect('/admin/websites')->with('success','Website Added');
    }


      /**
     * Show edit website form.
     */
    public function edit($id)
    {
        $website = $this->service->getWebsiteForEdit($id);
        $clients = $this->service->listClients();
        $countries = $this->service->getCountries();
        $niches = $this->service->getNiches();

        return view('admin.websites.edit', compact('website', 'clients', 'countries', 'niches'));
    }

    /**
     * Update a website record.
     */
    public function update(WebsiteUpdateRequest $request, $id)
    {
        $data = $request->validated();

        // Keep updates explicit to avoid accidental mass assignment.
        $this->service->updateWebsite($id, $request->validated()
        );

        return redirect('/admin/websites')->with('success','Website Updated');
    }

    /**
     * Delete a website record.
     */
    public function destroy($id)
    {
        $this->service->deleteWebsite($id);

        return redirect('/admin/websites')->with('success','Website Deleted');
    }

    /**
     * Restore a soft deleted website.
     */
    public function restore($id)
    {
        $this->service->restoreWebsite($id);
        return redirect('/admin/websites')->with('success','Website Restored');
    }


}

  
