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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('text');
            $table->unsignedInteger('assessment_id');
            $table->unsignedBigInteger('reviewer_id');
            $table->unsignedBigInteger('reviewee_id');
            $table->unsignedSmallInteger('review_rate');
            $table->timestamps();
            //define foreign key constraints
            $table->foreign('assessment_id')->references('id')->on('assessments')->onDelete('cascade'); 
            $table->foreign('reviewer_id')->references('id')->on('users')->onDelete('cascade'); 
            $table->foreign('reviewee_id')->references('id')->on('users')->onDelete('cascade'); 

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
