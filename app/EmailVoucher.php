<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailVoucher extends Model
{
    protected $table = 'email_voucher';

    protected $fillable = ['email'];
}
