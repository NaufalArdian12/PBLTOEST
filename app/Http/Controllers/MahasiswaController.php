<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MahasiswaController extends Controller
{
    public function dashboard()
    {
        return view('mahasiswa.dashboard');
    }

    public function sertifikat()
    {
        // Logika download sertifikat
        return response()->download(public_path('sertifikat/jupri.pdf'));
    }

    
}
