<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\SearchRequest;
use App\Services\SearchService;
use Illuminate\Routing\Controller;

class HospitalController extends Controller
{
    public function search(SearchRequest $searchRequest, SearchService $service): array
    {
        return $service->search($searchRequest);
    }
}
