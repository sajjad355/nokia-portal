<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    protected $fillable = [
        'file_name', 'imei', 'file_for', 'file_type', 'upload_by', 'status', 'file_location', 'sales_id',
    ];
}
