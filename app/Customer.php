<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    protected $fillable = ['fullname', 'birthday', 'gender', 'email', 'phone', 'user_id'];

    public function addresses()
    {
        return $this->hasMany('App\CustomerAddress', 'customer_id');
    }
    public function companies()
    {
        return $this->hasOne(Company::class, 'customer_id');
    }

    public function orders()
    {
        return $this->hasMany('App\Order', 'customer_id');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product', 'customer_product')->withPivot('id');
    }

    public function productlikes()
    {
        return $this->belongsToMany('App\Product', 'customer_product_like');
    }

    public function commentthanks()
    {
        return $this->hasMany('App\CustomerCommentThank');
    }

    public function gifts()
    {
        return $this->hasMany('App\Gift', 'customer_id');
    }

    public function questions()
    {
        return $this->hasMany('App\Question', 'customer_id', 'id');
    }

    public function likequestions()
    {
        return $this->belongsToMany('App\Question', 'customer_qa_like');
    }

    public function likeanswers()
    {
        return $this->belongsToMany('App\Answer', 'customer_qa_like');
    }
}
