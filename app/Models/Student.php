<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Student extends Model
{
    protected $table = 'Students_Info';

    protected $fillable = [
        'roll_no',
        'name',
        'class',
        'age',
        'gender',
        'hobies',
        'image'
    ];

    public function setAgeAttribute($value)
    {
        $this->attributes['age'] = Carbon::parse($value)->format('Y-m-d');
    }
}
