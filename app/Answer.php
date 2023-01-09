<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use SoftDeletes;
    protected $table = "answers";

    protected $fillable = ['answer', 'question_id', 'customer_id', 'status'];

    public function questions()
    {
        return $this->belongsTo('App\Question');
    }
    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }
    public function likeanswers()
    {
        return $this->hasMany('App\CustomerQALike', 'answer_id', 'id');
    }
}
