<?php

namespace App\Services;

use App\Enums\SearchType;
use App\Http\Requests\SearchRequest;
use App\Models\Hospital;

class SearchService
{
    public function search(SearchRequest $searchRequest)
    {
        $query = Hospital::query()->where(['region_id' => $searchRequest->region_id]);
        if ($searchRequest->type == SearchType::child()) {
            $query->where(['has_child' => true]);
        }
        if ($searchRequest->type == SearchType::adult()) {
            $query->where(['has_adult' => true]);
        }
        $query->where('diseases', '?&', "{\"$searchRequest->disease\"}");
        return $query->select(['id', 'name', 'has_child', 'has_adult'])->get()->all();
    }
}
