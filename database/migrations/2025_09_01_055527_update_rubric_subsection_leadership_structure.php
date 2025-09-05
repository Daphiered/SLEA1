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
        Schema::table('rubric_subsection_leadership', function (Blueprint $table) {
            // Drop existing columns
            $table->dropColumn(['position', 'points', 'position_order']);
            
            // Add new columns that match the view expectations
            $table->string('section_id', 50)->after('sub_items');
            $table->string('sub_section', 255)->after('section_id');
            $table->decimal('max_points', 5, 2)->after('sub_section');
            $table->unsignedTinyInteger('order_no')->default(1)->after('max_points');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rubric_subsection_leadership', function (Blueprint $table) {
            // Drop new columns
            $table->dropColumn(['section_id', 'sub_section', 'max_points', 'order_no']);
            
            // Restore original columns
            $table->string('position', 255)->after('sub_items');
            $table->decimal('points', 4, 2)->after('position');
            $table->unsignedTinyInteger('position_order')->default(1)->after('points');
        });
    }
};
