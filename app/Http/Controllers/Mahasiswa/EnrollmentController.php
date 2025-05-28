<?php

namespace App\Http\Controllers\Mahasiswa;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentModels;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\EnrollmentRequest;

class EnrollmentController extends Controller
{
    public function create()
    {
        return view('pendaftaran.create');
    }

    public function store(EnrollmentRequest $request)  // Gunakan EnrollmentRequest di sini
    {
        // Data sudah tervalidasi pada saat request diterima
        $student = new StudentModels();
        $student->user_id = Auth::id();
        $student->fill($request->except(['scan_ktp', 'scan_ktm', 'pas_foto']));

        // Menyimpan file yang diunggah
        $student->scan_ktp = $request->file('scan_ktp')->store('uploads/ktp', 'public');
        $student->scan_ktm = $request->file('scan_ktm')->store('uploads/ktm', 'public');
        $student->pas_foto = $request->file('pas_foto')->store('uploads/foto', 'public');

        // Menyimpan data mahasiswa
        $student->save();

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Pendaftaran berhasil!');
    }
}
