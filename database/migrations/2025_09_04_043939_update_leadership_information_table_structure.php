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
        Schema::table('leadership_information', function (Blueprint $table) {
            // Add missing fields according to ERD
            $table->string('leadership_type', 255)->nullable()->after('student_id');
            $table->string('activity_name', 255)->nullable()->after('leadership_type');
            $table->string('issued_by', 255)->nullable()->after('term');
            
            // Rename existing fields to match ERD
            $table->renameColumn('organization_name', 'organization_name');
            $table->renameColumn('organization_role', 'organization_role');
            $table->renameColumn('term', 'term');
            $table->renameColumn('hours_log', 'hours_log');
            $table->renameColumn('leadership_status', 'leadership_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leadership_information', function (Blueprint $table) {
            // Remove added fields
            $table->dropColumn(['leadership_type', 'activity_name', 'issued_by']);
        });
    }
};