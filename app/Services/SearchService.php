<?php

namespace App\Services;

use App\Enums\SearchType;
use App\Http\Requests\SearchRequest;
use App\Models\Hospital;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SearchService
{
    public function search(SearchRequest $searchRequest): array
    {
        $query = Hospital::query()->where(['region_id' => $searchRequest->region_id]);
        if ($searchRequest->type == SearchType::child()) {
            $query->where(['has_child' => true]);
        }
        if ($searchRequest->type == SearchType::adult()) {
            $query->where(['has_adult' => true]);
        }
        if ($searchRequest->has_rlo) {
            $query->where(['has_rlo' => true]);
        }
        if ($searchRequest->has_omc) {
            $query->where(['has_omc' => true]);
        }
        if ($searchRequest->has_vmp) {
            $query->where(['has_vmp' => true]);
        }
        if ($searchRequest->has_kd) {
            $query->where(['has_kd' => true]);
        }
        $query->where('diseases', '?&', "{\"$searchRequest->disease\"}");
        return $query->select(['id', 'name', 'has_child', 'has_adult'])->get()->all();
    }

    public function one(int $id): array
    {
        $hospital = Hospital::query()->where(['id' => $id])->first();
        if (!$hospital) {
            throw new NotFoundHttpException();
        }
        $res = $hospital->getAttributes();
        $res['doctors'] = $hospital->doctors;
        $res['diseases'] = $hospital->diseases;
        return $res;
    }
}
