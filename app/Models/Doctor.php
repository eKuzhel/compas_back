<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = ['fio', 'job_title'];

    public function hospital()
    {
        return $this->hasOne(Hospital::class, 'id', 'hospital_id');
    }
}
