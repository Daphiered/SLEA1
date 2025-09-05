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
        Schema::table('rubric_subsections', function (Blueprint $table) {
            // Drop the old foreign key constraint if it exists
            $table->dropForeign(['section_id']);
            
            // Add the correct foreign key constraint
            $table->foreign('section_id')
                  ->references('section_id')
                  ->on('rubric_sections')
                  ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rubric_subsections', function (Blueprint $table) {
            // Drop the correct foreign key constraint
            $table->dropForeign(['section_id']);
            
            // Restore the old foreign key constraint
            $table->foreign('section_id')
                  ->references('id')
                  ->on('sections')
                  ->cascadeOnDelete();
        });
    }
};
