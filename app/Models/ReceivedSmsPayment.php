<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReceivedSmsPayment extends Model
{
    protected $guarded = [];

    protected $casts = [
        'is_used' => 'boolean',
        'amount' => 'decimal:2',
        'used_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'used_by_user_id');
    }
}
