<?php

namespace App;

class Supplier extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'name', 'slug', 'address', 'phone', 'email', 'discount', 'updated_user_id'
    ];

    public function users()
    {
        return $this->belongsTo('App\User', 'updated_user_id');
    }
}
