<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('system_monitoring_and_logs', function (Blueprint $table) {
            // If the column doesn't exist yet, uncomment the next line:
            // $table->unsignedBigInteger('log_id')->after('logs_id');

            // Drop an old FK first if you had one with a different name
            // $table->dropForeign(['log_id']);

            $table->foreign('log_id')
                  ->references('log_id')
                  ->on('log_in')
                  ->cascadeOnDelete();   // delete logs when the login row is deleted
        });
    }

    public function down(): void
    {
        Schema::table('system_monitoring_and_logs', function (Blueprint $table) {
            $table->dropForeign(['log_id']);
        });
    }
};
