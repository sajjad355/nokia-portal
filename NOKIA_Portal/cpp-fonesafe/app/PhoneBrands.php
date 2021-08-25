<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhoneBrands extends Model
{
    protected $fillable = [
        'brand_name', 'status', 'added_by',
    ];
}
