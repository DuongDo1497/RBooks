<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
    protected $table = "comments";

    protected $fillable = ['customer_id', 'headding', 'content', 'rate', 'status'];

   	public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function commentthanks()
    {
        return $this->hasMany('App\CustomerCommentThank')->with('customer:id');
    }

    public function answercomments()
    {
        return $this->hasMany('App\AnswerComment')->with('customer:id,fullname');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product');
    }
}
