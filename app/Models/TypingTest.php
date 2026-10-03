<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypingTest extends Model
{
    protected $guarded = [];

    public function results()
    {
        return $this->hasMany(TestResult::class);
    }
}
