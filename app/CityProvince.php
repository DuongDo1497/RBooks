<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CityProvince extends Model
{
    use SoftDeletes;
    protected $table = "ns_cityprovinces";

    protected $fillable = ['name', 'type'];
}
