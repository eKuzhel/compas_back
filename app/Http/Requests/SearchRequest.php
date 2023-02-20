<?php


namespace App\Http\Requests;


use App\Enums\DiseaseType;
use App\Enums\SearchType;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read int $type
 * @property-read int $region_id
 * @property-read string $disease
 * Class CardToggleLike
 * @package App\Http\Requests
 */
class SearchRequest extends FormRequest
{
    /**
     * @return \string[][]
     */
    public function rules()
    {
        return [
            'type' => ['required', 'numeric', 'in:' . implode(',', SearchType::cases())],
            'region_id' => ['required', 'numeric', 'exists:regions,id'],
            'disease' => ['required', 'string', 'in:' . implode(',', DiseaseType::cases())],
        ];
    }
}
