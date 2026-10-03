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
        Schema::create('test_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('typing_test_id');
            $table->integer('gross_wpm')->default(0);
            $table->integer('net_wpm')->default(0);
            $table->decimal('accuracy', 5, 2)->default(0);
            $table->integer('total_errors')->default(0);
            $table->integer('time_taken_seconds')->default(0);
            $table->boolean('is_passed')->default(false);
            $table->longText('typed_text')->nullable(); // useful for sheet mode manual eval
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_results');
    }
};
