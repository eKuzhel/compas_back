<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 *
 * @property \Illuminate\Database\Eloquent\Collection $files
 */
class PageFile extends Model
{
    public function files(): BelongsToMany
    {
        return $this->belongsToMany(File::class, 'page_has_files', 'page_id', 'file_id');
    }
}
