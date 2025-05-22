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
        Schema::table('users', function (Blueprint $table) {
            // Set default role_id ke role_id dari 'Student' (id=3 atau sesuai dengan id di tabel roles)
            $table->foreignId('role_id')->default(3)->constrained('roles')->onDelete('cascade'); // Gantilah `3` dengan id yang sesuai
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
