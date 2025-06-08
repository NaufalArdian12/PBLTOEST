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
        if (auth()->user()->role->name === 'Admin') {
            $totalMahasiswa = StudentModels::count();
            $mahasiswaMendaftar = RegistrationModels::whereNotNull('student_id')->count();
            $mahasiswaBelumAcc = RegistrationModels::whereIn('status', ['pending', 'inactive'])->count();

            // Ambil data pendaftaran mahasiswa
            $registrations = RegistrationModels::all();

            $admin = auth()->user();
            return view('admin.dashboard.index' , compact('totalMahasiswa', 'mahasiswaMendaftar', 'mahasiswaBelumAcc', 'registrations', 'admin'));
        } else {    
            return view('mahasiswa.dashboard');
        }
    }

}
