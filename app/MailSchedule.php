<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MailSchedule extends Model
{
    use SoftDeletes;
    protected $table = "mail_schedules";

    protected $fillable = ['customer_id', 'order_number', 'order_date', 'product_id', 'sendmail_product_id', 'sendmail_date', 'sendmail_status'];
}
