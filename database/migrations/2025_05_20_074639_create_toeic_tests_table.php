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
        Schema::create('toeic_tests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained('admins')->onDelete('cascade');
            $table->foreignId('registration_id')->constrained('registrations')->onDelete('cascade');
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('educational_staff_id')->constrained('educational_staff')->onDelete('cascade');
            $table->date('date');
            $table->text('zoom_link');
            $table->integer('max_participants');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('toeic_tests');
    }

};
