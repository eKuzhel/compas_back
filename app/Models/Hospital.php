<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $casts = [
        'diseases' => 'json'
    ];

    public function region()
    {
        return $this->hasOne(Region::class, 'id', 'region_id');
    }

    /**
     * @return string[]
     */
    public static function getOptionList(): array
    {
        return self::query()->select(['id', 'name'])->orderBy('id')->pluck('name', 'id')->all();
    }
}
