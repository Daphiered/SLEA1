<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('rubric_categories', function (Blueprint $table) {
            $table->increments('category_id');                 // INTEGER (AI)
            $table->string('title', 50);                       // e.g., Leadership Excellence
            $table->decimal('max_points', 5, 2);               // e.g., 100.00
            $table->unsignedTinyInteger('order_no')->default(1); // "INTEGER (1)" -> tiny int 0..255
            $table->timestamps();

            $table->unique('title');                           // prevent duplicate category titles
            $table->unique('order_no');                        // keep global order unique (adjust if you prefer)
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rubric_categories');
    }
};
