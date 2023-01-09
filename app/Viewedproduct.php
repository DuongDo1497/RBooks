<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Viewedproduct extends Model
{
    use SoftDeletes;
    protected $table = "viewedproducts";

    protected $fillable = ['customer_id','product_id'];

   	public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product');
    }
}