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
        Schema::table('assessments', function (Blueprint $table) {
            $table->string('instruction')->nullable()->change();
            $table->unsignedSmallInteger('require_number')->nullable()->change();
            $table->unsignedInteger('max_score')->nullable()->change();
            $table->dateTime('due_dateTime')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assessments', function (Blueprint $table) {
            $table->string('instruction')->nullable(false)->change();
            $table->unsignedSmallInteger('require_number')->nullable(false)->change();
            $table->unsignedInteger('max_score')->nullable(false)->change();
            $table->dateTime('due_dateTime')->nullable(false)->change();
        });
    }
};
