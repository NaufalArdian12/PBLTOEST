<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PendaftaranController extends Controller
{
    public function create()
    {
        return view('pendaftaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|unique:students,nim',
            'nik' => 'required|string',
            'no_wa' => 'required|string',
            'alamat_asal' => 'required|string',
            'alamat_sekarang' => 'required|string',
            'program_studi' => 'required|string',
            'jurusan' => 'required|string',
            'kampus' => 'required|string|in:Utama,PSDKU Kediri,PSDKU Lumajang,PSDKU Pamekasan',
            'scan_ktp' => 'required|image|max:2048',
            'scan_ktm' => 'required|image|max:2048',
            'pas_foto' => 'required|image|max:2048',
        ]);

        $student = new StudentModels();
        $student->user_id = Auth::id();
        $student->fill($request->except(['scan_ktp', 'scan_ktm', 'pas_foto']));

        $student->scan_ktp = $request->file('scan_ktp')->store('uploads/ktp', 'public');
        $student->scan_ktm = $request->file('scan_ktm')->store('uploads/ktm', 'public');
        $student->pas_foto = $request->file('pas_foto')->store('uploads/foto', 'public');

        $student->save();

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Pendaftaran berhasil!');
    }
}
