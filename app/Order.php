<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = ['order_number','customer_id','warehouse_id','sub_cover_price','sub_total', 'tax_rate', 'tax_total', 'ship_total','gift_fee', 'total', 'status', 'note', 'delivery_address_id', 'billing_address_id', 'gift_address_id', 'payment_method', 'delivery_method', 'customerOrderId','orderRef', 'updated_user_id'];

    public function products()
    {
        return $this->belongsToMany('App\Product')->withPivot('quantity', 'price', 'total', 'discount', 'discount_total');
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer', 'customer_id');
    }
    public function vat()
    {
        return $this->belongsTo('App\Vat', 'order_id');
    }

    public function deliveryAddress()
    {
        return $this->belongsTo('App\OrderAddress','delivery_address_id');
    }

    public function billingAddress()
    {
        return $this->belongsTo('App\OrderAddress', 'billing_address_id');
    }
    public function GiftAddress()
    {
        return $this->belongsTo('App\Gift', 'gift_address_id');
    }
}
