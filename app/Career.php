<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Career extends Model
{
	use SoftDeletes;
    protected $table = "careers";

    protected $fillable = ['fullname', 'phone', 'email', 'gender', 'apply_position', 'file_cv', 'status', 'updated_user_id'];
}
