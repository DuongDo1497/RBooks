<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerCommentThank extends Model
{
    protected $table = 'customer_comment_thank';

    protected $fillable = ['customer_id', 'comment_id'];

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

}
