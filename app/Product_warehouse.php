<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_warehouse extends Model
{
    protected $table = 'product_warehouse';

    protected $fillable = ['product_id','warehouse_id', 'quantity'];
}
