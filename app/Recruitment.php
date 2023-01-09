<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recruitment extends Model
{
    use SoftDeletes;
    protected $table = 'recruitments';
    protected $fillable = [
        'title', 'vacancies', 'quantity', 'application_deadline', 'status',
    ];
    public function job_description()
    {
        return $this->hasOne(Job_description::class);
    }
}
