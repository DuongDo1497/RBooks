<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use SoftDeletes;
    protected $table = 'wards';
    
    protected $fillable = ['id','name','type','district_id'];
    
}
