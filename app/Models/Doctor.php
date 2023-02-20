<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    public function hospital()
    {
        return $this->hasOne(Hospital::class, 'id', 'hospital_id');
    }
}
