<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentModels;
use App\Models\RegistrationModels;
use App\Http\Requests\RegistrationRequest;

class RegistrationController extends Controller
{
    /**
     * Tampilkan form registrasi.
     */
    public function create()
    {
        return view('mahasiswa.registrasi.create');
    }

    /**
     * Simpan data registrasi.
     */
    public function store(RegistrationRequest $request) 
    {
        // Data sudah tervalidasi pada saat request diterima
        // Ambil mahasiswa berdasarkan user yang login
        $student = StudentModels::where('user_id', Auth::id())->firstOrFail();

        // Simpan data registrasi dengan NIM
        RegistrationModels::create([
            'NIM' => $student->nim,
            'registration_date' => $request->registration_date,
            'status' => $request->status,
        ]);

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Registrasi berhasil!');
    }
}


