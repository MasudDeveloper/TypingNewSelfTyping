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
        Schema::table('test_results', function (Blueprint $table) {
            $table->integer('total_keystrokes')->default(0)->after('net_wpm');
            $table->integer('total_words')->default(0)->after('total_keystrokes');
            $table->integer('correct_words')->default(0)->after('total_words');
            $table->integer('wrong_words')->default(0)->after('correct_words');
            $table->integer('omitted_words')->default(0)->after('wrong_words');
            $table->integer('extra_words')->default(0)->after('omitted_words');
            $table->decimal('error_percentage', 5, 2)->default(0)->after('accuracy');
            $table->integer('backspace_count')->default(0)->after('total_errors');
            $table->integer('tab_switch_warnings')->default(0)->after('backspace_count');
            $table->json('evaluation_details')->nullable()->after('typed_text');
        });

        Schema::table('typing_tests', function (Blueprint $table) {
            $table->boolean('backspace_allowed')->default(true)->after('mode');
            $table->string('sheet_pdf_url')->nullable()->after('backspace_allowed');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('test_results', function (Blueprint $table) {
            $table->dropColumn([
                'total_keystrokes',
                'total_words',
                'correct_words',
                'wrong_words',
                'omitted_words',
                'extra_words',
                'error_percentage',
                'backspace_count',
                'tab_switch_warnings',
                'evaluation_details',
            ]);
        });

        Schema::table('typing_tests', function (Blueprint $table) {
            $table->dropColumn([
                'backspace_allowed',
                'sheet_pdf_url',
            ]);
        });
    }
};
