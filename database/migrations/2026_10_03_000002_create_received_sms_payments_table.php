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
        Schema::create('received_sms_payments', function (Blueprint $table) {
            $table->id();
            $table->string('method')->default('bkash'); // bkash, nagad, rocket, upay
            $table->string('trx_id')->unique()->index();
            $table->decimal('amount', 10, 2);
            $table->string('sender_number')->nullable();
            $table->string('receiver_number')->nullable();
            $table->text('raw_sms')->nullable();
            $table->boolean('is_used')->default(false)->index();
            $table->unsignedBigInteger('used_by_user_id')->nullable();
            $table->timestamp('used_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('received_sms_payments');
    }
};
