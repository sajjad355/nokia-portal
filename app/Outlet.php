<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    protected $fillable = [
        'store_code', 'store_name', 'address', 'district', 'area', 'contact_details',
    ];
}
