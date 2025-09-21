<?php

namespace app\Http\Controllers\Admin;

use app\Models\StudentModels;
use app\Models\RegistrationModels;
use app\Http\Controllers\Controller;
use Illuminate\Http\Request;
use app\Models\ToeicTestModels;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index()
    {
        if (auth()->user()->role->name === 'Admin') {
            $totalMahasiswa = StudentModels::count();
            $mahasiswaMendaftar = RegistrationModels::whereNotNull('student_id')->count();
            $mahasiswaBelumAcc = RegistrationModels::whereIn('status', ['pending', 'inactive'])->count();

            // Ambil semua data pendaftaran
            $registrations = RegistrationModels::all();

            $admin = auth()->user();

            return view('admin.dashboard.index', compact(
                'totalMahasiswa',
                'mahasiswaMendaftar',
                'mahasiswaBelumAcc',
                'registrations',
                'admin'
            ))->with('success', 'Login successful!');
        } else {
            // Ambil TOEIC test beserta jumlah pendaftar
            $toeicTests = ToeicTestModels::withCount('registrations')->get();

            $student = auth()->user()->students;
            $registeredTestId = $student?->registration?->toeic_test_id;

            if ($student) {
                $registration = RegistrationModels::where('student_id', $student->id)->first();
                $registeredTestId = $registration?->toeic_test_id;
            }

            return view('mahasiswa.dashboard', compact('toeicTests', 'registeredTestId'))->with('success', 'Login successful!');
        }
    }


}
