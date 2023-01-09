<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    protected $table = 'customer_addresses';

    protected $fillable = ['address', 'ward', 'district', 'city', 'phone', 'fullname', 'default', 'customer_id'];

    public function customers()
    {
        return $this->belongsTo('App\Customer', 'customer_id');
    }
    public function city()
    {
        return $this->belongsToMany('App\City');
    }
    public function district()
    {
        return $this->belongsToMany('App\District');
    }
    public function ward()
    {
        return $this->belongsToMany('App\Ward');
    }
}
