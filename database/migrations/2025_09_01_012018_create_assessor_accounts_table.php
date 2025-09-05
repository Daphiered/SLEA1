<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('assessor_accounts', function (Blueprint $table) {
            $table->string('email_address', 50)->primary();
            $table->string('admin_id', 50);
            $table->string('last_name', 50);
            $table->string('first_name', 50);
            $table->string('middle_name', 50)->nullable();
            $table->string('position', 50);
            $table->string('default_password', 50);
            $table->dateTime('dateacc_created');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('assessor_accounts');
    }
};
