<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Carbon\Carbon;
use Kyslik\ColumnSortable\Sortable;

class Student extends Model
{
    use Sortable;
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
    public $sortable = [
        'roll_no',
        'name'
    ];

    // public function setAgeAttribute($value)
    // {
    //     $this->attributes['age'] = Carbon::parse($value)->format('Y-m-d');
    // }
}

