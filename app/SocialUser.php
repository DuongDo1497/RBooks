<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialUser extends Model
{
	protected $table = 'socialuser';

    protected $fillable = ['user_id', 'social_id', 'provider'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
