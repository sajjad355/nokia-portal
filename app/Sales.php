<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $fillable = [
        'store_id', 'imei', 'brand', 'model', 'price', 'gender', 'customer_name', 'date_of_birth', 'mobile', 'emergency_contact', 'email', 'district', 'address', 'image','cpp_price', 'fs_code', 'device_purchase_date',
    ];
}
