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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('level'); 
            $table->text('question_text');
            $table->text('option_r');
            $table->text('option_i');
            $table->text('option_a');
            $table->text('option_s');
            $table->text('option_e');
            $table->text('option_c');
            $table->integer('question_order');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
