<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailGift extends Model
{
    protected $table = 'email_gift';

    protected $fillable = ['email', 'name', 'phone', 'address'];
}
