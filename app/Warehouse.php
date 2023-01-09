<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $table = 'warehouses';

    protected $fillable = ['name','address', 'phone', 'fee_percent', 'profit_percent', 'updated_user_id' ];
}
