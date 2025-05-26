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
        Schema::create('majors', function (Blueprint $table) {
            $table->id();
            $table->string('major_name', 100);
            $table->foreignId('campu_id')->constrained('campuses')->onDelete('cascade');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();  // Kolom untuk soft delete
        });
    }

    public function down()
    {
        Schema::dropIfExists('majors');
    }

};
