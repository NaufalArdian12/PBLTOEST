<?php

namespace App\Http\Controllers\Admin;

use App\Models\StudentModels;
use App\Models\RegistrationModels;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMahasiswa = StudentModels::count();
        $mahasiswaMendaftar = RegistrationModels::whereNotNull('student_id')->count();
        $mahasiswaBelumAcc = RegistrationModels::where('status', 'pending')->count();

        // Ambil data pendaftaran mahasiswa
        $registrations = RegistrationModels::all();

        return view('admin.dashboard.index', compact('totalMahasiswa', 'mahasiswaMendaftar', 'mahasiswaBelumAcc', 'registrations'));
    }

}
