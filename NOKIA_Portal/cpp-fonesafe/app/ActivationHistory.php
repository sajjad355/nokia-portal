<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivationHistory extends Model
{
    protected $fillable = [
        'store_id', 'imei', 'model', 'price', 'fs_code', 'purchase_date', 'status'
    ];
}
