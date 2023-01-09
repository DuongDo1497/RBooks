<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vat extends Model
{
    protected $table = 'vats';

    protected $fillable = ['name_company', 'code_vat', 'address_company', 'order_id'];

    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
