<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use SoftDeletes;
    protected $table = 'cities';

    protected $fillable = ['id','name','type'];

    public function district()
    {
        return $this->hasMany('App\District');
    }
}

