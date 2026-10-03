<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('typing_tests', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('content');
            $table->string('category')->default('Basic'); // e.g. BCC Lab, BUET Lab
            $table->enum('language', ['en', 'bn_unicode', 'bn_bijoy'])->default('en');
            $table->enum('mode', ['screen', 'sheet'])->default('screen');
            $table->integer('time_limit_minutes')->default(5);
            $table->integer('pass_wpm')->default(25);
            $table->unsignedBigInteger('institution_id')->nullable();
            $table->boolean('is_premium')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('typing_tests');
    }
};
