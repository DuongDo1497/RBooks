<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use SoftDeletes;
    protected $table = 'districts';

    protected $fillable = ['id','name','type','city_id'];
    public function ward()
    {
        return $this->hasMany('App\Ward');
    }

}
