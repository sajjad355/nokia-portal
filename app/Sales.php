<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $fillable = [
        'store_id', 'imei', 'brand', 'status', 'invoice', 'model', 'price', 'gender', 'customer_name', 'paymentTime','date_of_birth', 'mobile', 'emergency_contact', 'email', 'district', 'tranxactionId', 'transactionStatus', 'address', 'image','cpp_price', 'fs_code', 'device_purchase_date',
    ];
}
