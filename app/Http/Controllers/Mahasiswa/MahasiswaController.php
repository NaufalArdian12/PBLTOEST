<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;

class MahasiswaController extends Controller
{
    public function index()
    {
        return view('mahasiswa.dashboard');
    }

    public function profile()
    {
        // Logika untuk menampilkan profil mahasiswa
        return view('mahasiswa.profile');
    }

    public function sertifikat()
    {
        // Logika download sertifikat
        return response()->download(public_path('sertifikat/jupri.pdf'));
    }
}
