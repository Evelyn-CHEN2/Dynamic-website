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
        Schema::create('assessment_score', function (Blueprint $table) {
            $table->id();
            $table->float('score',4,2);
            $table->string('assessment_id');
            $table->string('enrollment_id');
            $table->timestamps();
            //define foreign key contraints
            $table->foreign('assessment_id')->references('id')->on('assessments')->onDelete('cascade'); 
            $table->foreign('enrollment_id')->references('id')->on('enrollments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessment_score');
    }
};
