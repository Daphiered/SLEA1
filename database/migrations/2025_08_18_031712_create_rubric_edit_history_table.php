<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('rubric_edit_history', function (Blueprint $table) {
            $table->bigIncrements('edit_id');                   // PK
            $table->string('admin_id', 15);                     // FK candidate if you have admins table
            $table->unsignedBigInteger('sub_items');            // FK -> rubric_subsection_leadership
            $table->dateTime('edit_timestamp');
            $table->string('changes_made', 255)->nullable();
            $table->string('field_edited', 255)->nullable();
            $table->timestamps();

            $table->foreign('sub_items')
                  ->references('sub_items')
                  ->on('rubric_subsection_leadership')
                  ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rubric_edit_history');
    }
};
