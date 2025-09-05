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
        Schema::table('submission_records', function (Blueprint $table) {
            // Remove legacy fields that are no longer needed
            $table->dropColumn(['slea_category', 'subsection']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('submission_records', function (Blueprint $table) {
            // Add back the legacy fields if needed to rollback
            $table->string('slea_category', 255)->nullable();
            $table->string('subsection', 255)->nullable();
        });
    }
};


