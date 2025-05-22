<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            // Menambahkan kolom untuk scan KTP, scan KTM, dan pas foto
            $table->string('scan_ktp')->nullable();  // Kolom untuk scan KTP
            $table->string('scan_ktm')->nullable();  // Kolom untuk scan KTM
            $table->string('passport_photo')->nullable();  // Kolom untuk pas foto
            $table->timestamp('deleted_at')->nullable();  // Kolom untuk soft delete
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            //
        });
    }
};
