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
        Schema::create('educational_staff', function (Blueprint $table) {
            $table->id();
            $table->string('NIP', 20)->unique();
            $table->string('name', 100);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();  // Kolom untuk soft delete
        });
    }

    public function down()
    {
        Schema::dropIfExists('educational_staff');
    }

};
