<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Membuat tabel roles
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');  // Menambahkan constraint unique
            $table->timestamps();
        });


        // Mengubah tabel users (menghapus foreign key yang sebelumnya)
        // Tidak menambahkan foreign key ke tabel users untuk sekarang
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Menghapus tabel roles
        Schema::dropIfExists('roles');
    }
};
