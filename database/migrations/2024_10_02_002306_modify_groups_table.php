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
        Schema::table('groups', function (Blueprint $table) {
            // To add a new column 'group_type' if it doesn't exist
            if (!Schema::hasColumn('groups', 'group_type')) {
                $table->string('group_type', 20)->default('student_select'); // Adding with a default value
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('groups', function (Blueprint $table) {
            // Dropping the 'group_type' column in the rollback
            $table->dropColumn('group_type');
        });
    }
};
