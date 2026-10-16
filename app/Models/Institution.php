<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    protected $guarded = [];

    protected $casts = [
        'subscription_status' => 'boolean',
        'subscription_expires_at' => 'datetime',
    ];

    public function isSubscriptionActive(): bool
    {
        if (!$this->subscription_status) {
            return false;
        }
        if ($this->subscription_expires_at && $this->subscription_expires_at < now()) {
            return false;
        }
        return true;
    }

    public function students()
    {
        return $this->hasMany(User::class, 'institution_id')->where('role', 'student');
    }

    public function admins()
    {
        return $this->hasMany(User::class, 'institution_id')->where('role', 'institution_admin');
    }

    public function tests()
    {
        return $this->hasMany(TypingTest::class, 'institution_id');
    }

    public function getBatchesAttribute(): array
    {
        return $this->students()
            ->whereNotNull('batch_name')
            ->where('batch_name', '!=', '')
            ->distinct()
            ->pluck('batch_name')
            ->toArray();
    }
}
