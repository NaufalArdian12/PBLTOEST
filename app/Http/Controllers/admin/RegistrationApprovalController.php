<?php
namespace App\Http\Controllers\Admin;

use App\Models\CampusModels;
use App\Models\Registration;
use App\Models\RegistrationModels;
use App\Models\StudentModels;
use App\Models\ToeicTestModels;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegistrationApprovalController extends Controller
{

    public function index()
    {
        // Mengambil semua data pendaftaran
        $registrations = RegistrationModels::all();

        $campuses = CampusModels::all(); // Mengambil daftar kampus unik

        // Mengirim data ke view
        return view('admin.registration.index', compact('registrations', 'campuses'));
    }
    // Method untuk Approve
    public function approve($id)
    {
        $registration = RegistrationModels::findOrFail($id);
        $registration->status = 'active';
        $registration->save();

        return redirect()->route('dashboard')->with('success', 'Registration approved successfully.');
    }

    // Method untuk Reject
    public function reject($id)
    {
        $registration = RegistrationModels::findOrFail($id);
        $registration->status = 'inactive';  // Mengubah status menjadi rejected
        $registration->save();

        return redirect()->route('dashboard')->with('success', 'Registration rejected successfully.');
    }

    // Method untuk menampilkan detail pendaftaran
    public function show($id)
    {
        $registration = RegistrationModels::findOrFail($id);
        return view('admin.registration.show', compact('registration'));
    }
    // Method untuk menghapus pendaftaran
    public function destroy($id)
    {
        $registration = RegistrationModels::findOrFail($id);
        $registration->delete();

        return redirect()->route('dashboard')->with('success', 'Registration deleted successfully.');
    }
    // Method untuk menampilkan form edit pendaftaran
    public function edit($id)
    {
        // Fetch the registration, student, and TOEIC test data
        $registration = RegistrationModels::findOrFail($id);
        $students = StudentModels::all();  // All students for the dropdown
        $toeicTests = ToeicTestModels::all();  // All TOEIC tests for the dropdown

        return view('admin.registration.edit', compact('registration', 'students', 'toeicTests'));
    }

    // Update the specified registration in storage
    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'toeic_test_id' => 'required|exists:toeic_tests,id',
            'registration_date' => 'required|date',
            'status' => 'required|in:pending,active,inactive',  // Add more statuses if needed
        ]);

        // Fetch the registration record to update
        $registration = RegistrationModels::findOrFail($id);

        // Update the registration with the new data
        $registration->update([
            'student_id' => $request->student_id,
            'toeic_test_id' => $request->toeic_test_id,
            'registration_date' => $request->registration_date,
            'status' => $request->status,  // Update the status
        ]);

        // Redirect to the dashboard or registration list with a success message
        return redirect()->route('registration.index')->with('success', 'Registration updated successfully.');
    }

    // Show the form for creating a new registration
    public function create()
    {
        $students = StudentModels::all(); // Fetch all students
        $toeicTests = ToeicTestModels::all(); // Fetch all TOEIC tests

        return view('admin.registration.create', compact('students', 'toeicTests'));
    }

    // Store the newly created registration
    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'toeic_test_id' => 'required|exists:toeic_tests,id',
            'registration_date' => 'required|date',
            'status' => 'required|in:pending,active,inactive', // Add more statuses if needed
        ]);
        // Check if the student is already registered for the TOEIC test
        $existingRegistration = RegistrationModels::where('student_id', $request->student_id)
            ->where('toeic_test_id', $request->toeic_test_id)
            ->first();
        if ($existingRegistration) {
            return redirect()->back()->with('error', 'This student is already registered for this TOEIC test.');
        }

        // Get the TOEIC Test by ID
        $toeicTest = ToeicTestModels::find($request->toeic_test_id);

        // Check if the number of participants has reached the max limit
        $currentParticipantsCount = RegistrationModels::where('toeic_test_id', $toeicTest->id)->count();

        if ($currentParticipantsCount >= $toeicTest->max_participants) {
            return redirect()->back()->with('error', 'The maximum number of participants for this TOEIC test has been reached.');
        }

        // Create the registration record
        RegistrationModels::create([
            'student_id' => $request->student_id,
            'toeic_test_id' => $request->toeic_test_id,
            'registration_date' => $request->registration_date,
            'status' => $request->status,  // Default can be 'pending' or something else
        ]);

        // Redirect to the index page with a success message
        return redirect()->route('registration.index')->with('success', 'Registration created successfully.');
    }

}
