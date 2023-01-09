<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    
    protected $table = 'products';

    protected $fillable = ['sku','name','slug', 'quantitative', 'publishing_year', 'cover_price', 'sale_price', 'description', 'excerpt', 'quantity', 'status', 'updated_user_id'];

    public function images()
    {
        return $this->belongsToMany('App\Image');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    public function comments()
    {
        return $this->belongsToMany('App\Comment')->with(['answercomments:comment_id,answer_cmt,status,customer_id', 'commentthanks']);
    }

    public function questions()
    {
        return $this->hasMany('App\Question');
    }

    public function warehouses()
    {
        return $this->belongsToMany('App\Warehouse', 'product_warehouse')->withPivot('quantity','sale_price','status', 'fee', 'profit');
    }
    public function product_warehouse()
    {
        return $this->hasMany('App\Product_warehouse','product_id');
    }

    public function customers()
    {
        return $this->belongsToMany('App\Customer', 'customer_product');
    }
    public function gifts()
    {
        return $this->belongsToMany('App\Gift');
    }
    public function orders()
    {
        return $this->belongsToMany('App\Order');
    }
}
