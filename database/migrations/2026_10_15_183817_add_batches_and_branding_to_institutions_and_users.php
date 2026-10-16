<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('institutions', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('slug');
            $table->string('email')->nullable()->after('phone');
            $table->string('address')->nullable()->after('email');
            $table->string('tagline')->nullable()->after('address');
            $table->string('signature_path')->nullable()->after('logo_path');
            $table->string('package_name')->default('Standard Coaching (50 Students)')->after('subscription_status');
            $table->integer('student_limit')->default(50)->after('package_name');
            $table->timestamp('subscription_expires_at')->nullable()->after('student_limit');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('batch_name')->nullable()->after('institution_id');
            $table->string('student_roll')->nullable()->after('batch_name');
        });
    }

    public function down(): void
    {
        Schema::table('institutions', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'email',
                'address',
                'tagline',
                'signature_path',
                'package_name',
                'student_limit',
                'subscription_expires_at'
            ]);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['batch_name', 'student_roll']);
        });
    }
};
