<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

final class Region extends Model implements Sortable
{
    use SortableTrait;

    public $sortable = [
        'order_column_name' => 'order_number',
        'sort_when_creating' => true,
    ];


    /**
     * @return string[]
     */
    public static function getOptionList(): array
    {
        return self::query()->select(['id', 'name'])->orderBy('id')->pluck('name', 'id')->all();
    }
}
