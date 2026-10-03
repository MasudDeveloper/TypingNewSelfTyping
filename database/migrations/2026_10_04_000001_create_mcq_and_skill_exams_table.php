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
        Schema::create('mcq_exams', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category')->default('BCC & Computer Operator');
            $table->integer('time_limit_minutes')->default(15);
            $table->decimal('total_marks', 8, 2)->default(20);
            $table->decimal('pass_marks', 8, 2)->default(10);
            $table->decimal('negative_marking', 5, 2)->default(0.25);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('mcq_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mcq_exam_id');
            $table->text('question');
            $table->string('option_a');
            $table->string('option_b');
            $table->string('option_c');
            $table->string('option_d');
            $table->enum('correct_option', ['a', 'b', 'c', 'd']);
            $table->text('explanation')->nullable();
            $table->timestamps();
        });

        Schema::create('written_questions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category')->default('Ministry & Directorate');
            $table->string('organization')->nullable();
            $table->string('exam_year')->nullable();
            $table->longText('question_content')->nullable();
            $table->string('pdf_url')->nullable();
            $table->timestamps();
        });

        Schema::create('practical_questions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('software', ['excel', 'powerpoint', 'word', 'access'])->default('excel');
            $table->text('problem_statement');
            $table->text('step_instructions')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('practical_questions');
        Schema::dropIfExists('written_questions');
        Schema::dropIfExists('mcq_questions');
        Schema::dropIfExists('mcq_exams');
    }
};
