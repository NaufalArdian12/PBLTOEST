<?php
namespace App\Http\Controllers\Auth;

use app\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use app\Models\UserModels;
use app\Models\StudentModels;
use app\Models\StudyProgramModels;

class VerificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Menampilkan halaman verifikasi email
    public function show(Request $request)
    {
        if ($request->user() && $request->user()->hasVerifiedEmail()) {
            return redirect('/dashboard');
        }
        return view('auth.verify-email');
    }

    public function verify(Request $request)
    {
        if (!$request->user()) {
            return redirect('/login');
        }

        if ($request->user()->hasVerifiedEmail()) {
            return redirect('/dashboard');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        // Redirect to set password page
        return redirect()->route('password.set');
    }

    // Menampilkan halaman untuk mengatur password
    public function showSetPasswordForm(Request $request)
    {
        $studyPrograms = studyProgramModels::all();
        return view('auth.set-password', compact('studyPrograms'));
    }

    // Menyimpan password yang diinput oleh pengguna
    public function storePassword(Request $request)
    {
        try {
            // dd(auth()->user());
            $user = auth()->user(); // User sudah login via Google

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'NIM' => 'required|string|max:255|unique:students,NIM,' . ($user->student ? $user->student->id : 'NULL'),
                'NIK' => 'required|string|max:255|unique:students,NIK,' . ($user->student ? $user->student->id : 'NULL'),
                'origin_address' => 'required|string|max:255',
                'telephone_number' => 'required|string|max:255',
                'current_address' => 'required|string|max:255',
                'study_program_id' => 'required|exists:study_programs,id',
                'scan_ktp' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'scan_ktm' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'pas_photo' => 'required|file|mimes:jpg,jpeg,png|max:2048',
                'password' => 'required|string|min:8|confirmed',
            ]);

            // Simpan file
            $scan_ktp_path = $request->file('scan_ktp')->store('private/scans');
            $scan_ktm_path = $request->file('scan_ktm')->store('private/scans');
            $pas_photo_path = $request->file('pas_photo')->store('private/photos');

            // Update user yang sudah ada (bukan create baru)
            $user->update([
                'name' => $validated['name'],
                'password' => bcrypt($validated['password']), // Update password
            ]);

            // Check if the student already exists for this user
            $existingStudent = StudentModels::where('user_id', $user->id)->first();

            if ($existingStudent) {
                // If student exists, update the student record
                $existingStudent->update([
                    'NIM' => $validated['NIM'],
                    'NIK' => $validated['NIK'],
                    'study_program_id' => $validated['study_program_id'],
                    'scan_ktp' => $scan_ktp_path,
                    'scan_ktm' => $scan_ktm_path,
                    'pas_photo' => $pas_photo_path,
                    'current_address' => $validated['current_address'],
                    'origin_address' => $validated['origin_address'],
                    'telephone_number' => $validated['telephone_number'],
                ]);

                return redirect('/dashboard')->with('success', 'Profile updated successfully!');
            }

            // If student doesn't exist, create a new student
            $student = StudentModels::create([
                'user_id' => $user->id, // Relasikan dengan user yang sudah ada
                'NIM' => $validated['NIM'],
                'NIK' => $validated['NIK'],
                'study_program_id' => $validated['study_program_id'],
                'scan_ktp' => $scan_ktp_path,
                'scan_ktm' => $scan_ktm_path,
                'pas_photo' => $pas_photo_path,
                'current_address' => $validated['current_address'],
                'origin_address' => $validated['origin_address'],
                'telephone_number' => $validated['telephone_number'],
            ]);

            return redirect('/dashboard')->with('success', 'Profile completed successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error: ' . $e->getMessage());
        }
    }


    public function resend(Request $request)
    {
        $user = $request->user();
        if (!$request->user()) {
            return redirect('/login');
        }

        if ($request->user()->hasVerifiedEmail()) {
            return redirect('dashboard')->with('message', 'Your Email is already verified!');
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }
}

