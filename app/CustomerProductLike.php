<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerProductLike extends Model
{
    protected $table = 'customer_product_like';

    protected $fillable = ['customer_id', 'product_id'];

}
