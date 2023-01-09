<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerQALike extends Model
{
    protected $table = 'customer_qa_like';

    protected $fillable = ['customer_id', 'question_id', 'answer_id', 'like_question', 'like_answer'];

}
