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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('image_url')->nullable();
            $table->decimal('price', 8, 2)->default(0);
            $table->decimal('original_price', 8, 2)->nullable();
            $table->string('discount_percent')->nullable();
            $table->string('stock_status')->default('In Stock'); // In Stock / Out of Stock
            $table->string('external_url');
            $table->string('accent_color')->default('#2563eb');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
