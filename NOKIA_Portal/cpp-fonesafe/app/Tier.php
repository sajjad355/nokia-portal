<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tier extends Model
{
    protected $fillable = [
        'tier', 'price_range_start', 'price_range_end', 'status', 'added_by',
    ];
}
