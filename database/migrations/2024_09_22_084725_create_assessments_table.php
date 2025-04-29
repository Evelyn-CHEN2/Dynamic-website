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
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('instruction')->nullable();
            $table->unsignedSmallInteger('require_number')->nullable();
            $table->unsignedInteger('max_score')->nullable();
            $table->dateTime('due_dateTime')->nullable();
            $table->string('course_code');
            $table->timestamps();
            //define foreign key constraints
            $table->foreign('course_code')->references('course_code')->on('courses')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};
