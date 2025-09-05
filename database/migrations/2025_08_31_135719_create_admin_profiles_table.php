<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('admin_profiles', function (Blueprint $table) {
            $table->string('admin_id', 15)->primary();
            $table->string('email_address', 50)->unique();
            $table->string('name', 255);
            $table->string('contact_number', 15)->nullable();
            $table->string('position', 50)->nullable();
            $table->string('picture_path', 255)->nullable();
            $table->dateTime('date_upload')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('admin_profiles');
    }
};
