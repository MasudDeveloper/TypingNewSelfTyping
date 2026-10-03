<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    protected $guarded = [];

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
}
