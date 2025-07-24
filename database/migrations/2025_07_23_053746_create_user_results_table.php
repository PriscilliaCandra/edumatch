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
        Schema::create('user_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('score_realistic')->default(0);
            $table->integer('score_investigative')->default(0);
            $table->integer('score_artistic')->default(0);
            $table->integer('score_social')->default(0);
            $table->integer('score_enterprising')->default(0);
            $table->integer('score_conventional')->default(0);
            $table->string('personality_type');
            $table->text('recommended_majors');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_results');
    }
};
