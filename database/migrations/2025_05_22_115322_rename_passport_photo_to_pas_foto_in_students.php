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
            $table->renameColumn('passport_photo', 'pas_foto');
        });
    }

    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->renameColumn('pas_foto', 'passport_photo');
        });
    }

};
