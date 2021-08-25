<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceiveDeliveryHistory extends Model
{
    protected $fillable = [
        'store_id', 'imei', 'status',
    ];
}
