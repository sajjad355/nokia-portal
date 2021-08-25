<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fsecure extends Model
{
    protected $table = 'fsecure';
    protected $fillable = [
        'fsecure_code', 'service_type', 'status', 'imei', 'used_at'
    ];
}
