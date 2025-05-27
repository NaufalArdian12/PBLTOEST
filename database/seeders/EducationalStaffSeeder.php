<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserModels;
use App\Models\EducationalStaffModels;
use Illuminate\Support\Facades\Hash;

class EducationalStaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            // Menambahkan pengguna admin baru
        // Seeder untuk menambahkan admin ke tabel admins
        $user = UserModels::create([
            'name' => 'Dosen 2',
            'email' => 'oranjistudioofficial@gmail.com',
            'password' => Hash::make('12345678'),
            'role_id' => 2,  // Admin role
        ]);

        // Setelah pengguna dibuat, masukkan ke dalam tabel admins
        EducationalStaffModels::create([
            'user_id' => $user->id,
            'NIP' => '1234567891',
        ]);
    }
}
