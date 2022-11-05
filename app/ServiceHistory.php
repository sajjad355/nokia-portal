<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceHistory extends Model
{
    protected $fillable = [
        'store_id', 'imei', 'model', 'price', 'fs_code', 'purchase_date', 'status', 'delivery_date'
    ];
}
