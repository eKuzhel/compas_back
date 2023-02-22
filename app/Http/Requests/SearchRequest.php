<?php


namespace App\Http\Requests;


use App\Enums\DiseaseType;
use App\Enums\SearchType;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read int $type
 * @property-read int $region_id
 * @property-read string $disease
 * @property-read boolean $has_rlo
 * @property-read boolean $has_omc
 * @property-read boolean $has_vmp
 * @property-read boolean $has_vzn
 * @property-read boolean $has_kd
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
            'has_rlo' => ['boolean'],
            'has_omc' => ['boolean'],
            'has_vmp' => ['boolean'],
            'has_vzn' => ['boolean'],
            'has_kd' => ['boolean'],
        ];
    }
}
