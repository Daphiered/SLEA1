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
        // Drop the existing table with wrong structure
        Schema::dropIfExists('rubric_subsection_leadership');
        
        // Recreate the table with correct structure
        Schema::create('rubric_subsection_leadership', function (Blueprint $table) {
            $table->bigIncrements('leadership_id');        // PK (AI)
            $table->unsignedBigInteger('sub_items');       // FK -> rubric_subsections.sub_items
            $table->string('position', 255);
            $table->decimal('points', 4, 2);
            $table->unsignedTinyInteger('position_order')->default(1);
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('sub_items')
                  ->references('sub_items')
                  ->on('rubric_subsections')
                  ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rubric_subsection_leadership');
    }
};
