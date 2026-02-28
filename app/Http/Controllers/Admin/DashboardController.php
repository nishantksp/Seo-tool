<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Website;
use App\Models\Keyword;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'clients' => User::where('role','client')->count(),
            'websites' => Website::count(),
            'keywords' => Keyword::count(),
        ]);
    }
}