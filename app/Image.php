<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
     protected $table = 'images';

    protected $fillable = ['name', 'slug', 'path', 'filename'];

    public function products()
    {
        return $this->belongsToMany('App\Product', 'image_product', 'image_id', 'product_id');
    }
}
