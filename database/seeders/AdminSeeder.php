<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use app\Models\UserModels;
use app\Models\AdminModels;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan pengguna admin baru
        // Seeder untuk menambahkan admin ke tabel admins
        $user = UserModels::create([
            'name' => 'Admin Utama',
            'email' => 'naufalportofolio12@gmail.com',
            'password' => Hash::make('12345678'),
            'role_id' => 1,  // Admin role
        ]);

        // Setelah pengguna dibuat, masukkan ke dalam tabel admins
        AdminModels::create([
            'user_id' => $user->id,
        ]);
    }
}
