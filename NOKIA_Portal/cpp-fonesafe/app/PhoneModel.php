<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhoneModel extends Model
{
    protected $fillable = [
        'model_name', 'brand_name', 'mrp', 'mrp_ew', 'status', 'added_by', 'service_type', 'device_price', 'Cpp_Price',
    ];
}
