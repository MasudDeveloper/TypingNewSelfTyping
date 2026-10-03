<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class McqQuestion extends Model
{
    protected $guarded = [];

    public function exam()
    {
        return $this->belongsTo(McqExam::class, 'mcq_exam_id');
    }
}
