<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnswerComment extends Model
{
    use SoftDeletes;
    protected $table = "answer_comments";

    protected $fillable = ['answer_cmt', 'comment_id', 'customer_id', 'status'];

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function comment()
    {
        return $this->belongsTo('App\Comment', 'id', 'comment_id');
    }
}
