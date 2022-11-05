<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fscodes extends Model
{
    protected $fillable = [
        'fscode', 'tier', 'status', 'sale_date', 'sale_by'
    ];
}
