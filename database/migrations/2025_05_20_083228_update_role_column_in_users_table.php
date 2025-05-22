<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Step 1: Update existing NULL values to default role
        DB::table('users')
            ->whereNull('role')
            ->update(['role' => 'Student']);

        // Step 2: Modify the column for PostgreSQL
        DB::statement("
            ALTER TABLE users
            DROP CONSTRAINT IF EXISTS users_role_check;
        ");

        DB::statement("
            ALTER TABLE users
            ALTER COLUMN role TYPE VARCHAR(255),
            ALTER COLUMN role SET NOT NULL,
            ALTER COLUMN role SET DEFAULT 'Student';
        ");

        DB::statement("
            ALTER TABLE users
            ADD CONSTRAINT users_role_check
            CHECK (role IN ('Educational Staff', 'Dosen', 'Student', 'UPA_bahasa'));
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        DB::statement("
            ALTER TABLE users
            DROP CONSTRAINT IF EXISTS users_role_check;
        ");

        Schema::table('users', function (Blueprint $table) {
            $table->string('role')
                  ->nullable()
                  ->default(null)
                  ->change();
        });
    }
};
