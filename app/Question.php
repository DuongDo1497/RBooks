<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;
    protected $table = "questions";

    protected $fillable = ['customer_id','product_id', 'question', 'status', 'like'];

   	public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function products()
    {
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }
    public function answers()
    {
        return $this->hasMany('App\Answer', 'question_id', 'id');
    }
    public function likequestions()
    {
        return $this->hasMany('App\CustomerQALike', 'question_id', 'id');
    }
}
