<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job_description extends Model
{
    use SoftDeletes;
    protected $table = "job_descriptions"; // Quá trình bhxh

    protected $fillable = [
        'introduction', 'benefit', 'address', 'salary', 'work_time', 'experience', 'requirements', 'orther_requirements', 'recruitment_id',
    ];

    public function recruitment()
    {
        return $this->belongsTo(Recruitment::class);
    }
}
