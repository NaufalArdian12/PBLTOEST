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
        Schema::create('study_programs', function (Blueprint $table) {
            $table->id();
            $table->string('study_program_name', 100);
            $table->foreignId('major_id')->constrained('majors')->onDelete('cascade');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();  // Kolom untuk soft delete
        });
    }

    public function down()
    {
        Schema::dropIfExists('study_programs');
    }

};
