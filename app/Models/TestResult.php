<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    protected $guarded = [];

    protected $casts = [
        'evaluation_details' => 'array',
        'is_passed' => 'boolean',
        'accuracy' => 'decimal:2',
        'error_percentage' => 'decimal:2',
    ];

    public function typingTest()
    {
        return $this->belongsTo(TypingTest::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
