<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MailProduct extends Model
{
    use SoftDeletes;
    protected $table = "mail_products";

    protected $fillable = ['name', 'product_id', 'description', 'next_product_id', 'aftersendday', 'ordernum'];
}
