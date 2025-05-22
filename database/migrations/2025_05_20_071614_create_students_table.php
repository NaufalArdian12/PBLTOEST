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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('NIM', 20)->unique();
            $table->string('NIK', 20);
            $table->string('scan_ktp')->nullable();  // Kolom untuk scan KTP
            $table->string('scan_ktm')->nullable();  // Kolom untuk scan KTM
            $table->string('pas_photo')->nullable();  // Kolom untuk pas foto
            $table->foreignId('study_program_id')->constrained()->onDelete('cascade');
            $table->foreignId('major_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();  // Kolom untuk soft delete
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }

};
