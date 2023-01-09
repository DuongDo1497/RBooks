<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Viewed_product extends Model
{
    use SoftDeletes;
    protected $table = "viewed_product";

    protected $fillable = ['viewed_id','product_id'];

   	public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product');
    }
}