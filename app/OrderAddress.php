<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
    protected $table = 'order_addresses';

    protected $fillable = ['address', 'ward', 'district', 'city', 'fullname', 'phone', 'email', 'note' ];
}
