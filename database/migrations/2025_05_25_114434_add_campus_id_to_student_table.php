<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            Schema::table('students', function (Blueprint $table) {
                $table->unsignedBigInteger('campus_id')->nullable(); // Add campus_id column
                $table->foreign('campus_id')->references('id')->on('campuses')->onDelete('set null'); // Foreign key relationship
            });

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            //database\migrations\2025_05_25_114434_add_campus_id_to_student_table.php
        });
    }
};
