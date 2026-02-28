<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\KeywordService;

class KeywordController extends Controller
{
    public function __construct(private KeywordService $service)
    {
    }

    public function index()
    {
        $keywords = $this->service->listClientKeywordsWithLatestRanking(auth()->id());

        return view('client.keywords', compact('keywords'));
    }
}


