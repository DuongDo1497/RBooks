<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gift extends Model
{
    use SoftDeletes;
    protected $table = "gifts";

    protected $fillable = ['gift_number','senderName', 'recipientName', 'address', 'phone', 'message', 'customer_id','order_id'];

   	public function customer()
    {
        return $this->belongsTo('App\Customer', 'customer_id');
    }
    public function order()
    {
        return $this->belongsTo('App\Order','order_id');
    }
}
