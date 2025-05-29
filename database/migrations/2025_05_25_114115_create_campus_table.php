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
        Schema::table('campus', function (Blueprint $table) {
            Schema::create('campuses', function (Blueprint $table) {
                $table->id();
                $table->string('campus_name');
                $table->timestamps();
                $table->timestamp('deleted_at')->nullable();  // Kolom untuk soft delete
            });

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('campus', function (Blueprint $table) {
            //
        });
    }
};
