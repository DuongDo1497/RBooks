<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = "coupons";

    protected $fillable = ['key', 'percent', 'quantity', 'quantitied', 'description'];

   	public function customers()
    {
        return $this->belongsToMany('App\Customer', 'coupon_customer')->withPivot('customer_id');
    }
}
