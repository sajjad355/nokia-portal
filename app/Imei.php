<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imei extends Model
{
    protected $fillable = [
        'imei', 'brand', 'model', 'device_price', 'status', 'sale_date', 'sale_by'
    ];
}
