<?php
namespace App\Http\Controllers\Admin;

use app\Models\CampusModels;
use app\Models\Registration;
use app\Models\RegistrationModels;
use app\Models\StudentModels;
use app\Models\ToeicTestModels;
use Illuminate\Http\Request;
use app\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use app\Mail\RegistrationApprovedMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;


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

    public function autoRegister(Request $request, $toeic_test_id)
    {
        $user = Auth::user();
        $student = $user->students;

        if (!$student) {
            return redirect()->back()->with('error', 'Your account is not yet connected to student data.');
        }

        // Cek kuota
        $toeicTest = ToeicTestModels::findOrFail($toeic_test_id);
        $count = RegistrationModels::where('toeic_test_id', $toeicTest->id)->count();

        if ($count >= $toeicTest->max_participants) {
            return redirect()->back()->with('error', 'This TOEIC quota is already full.');
        }

        try {
            // Simpan data
            RegistrationModels::create([
                'student_id' => $student->id,
                'toeic_test_id' => $toeicTest->id,
                'registration_date' => now(),
                'status' => 'pending',
            ]);
        } catch (QueryException $e) {
            if ($e->getCode() == '23505') {
                return redirect()->back()->with('error', 'You have already registered, you only get one chance to register');
            }
            return redirect()->back()->with('error', 'An error occurred during registration. Please try again.');
        }

        return redirect()->back()->with('success', 'Registration successful!');
    }


    // Method untuk Approve
    public function approve($id)
    {
        $registration = RegistrationModels::with(['student.user'])->findOrFail($id);
        $registration->status = 'active';
        $registration->save();

        // Ambil email mahasiswa terkait
        $student = $registration->student; // pastikan relasi student() ada di RegistrationModels
        if ($student && $student->user && $student->user->email) {
            Mail::to($student->user->email)->send(new RegistrationApprovedMail($registration));
        }


        return redirect()->route('dashboard')->with('success', 'Registration approved and email sent successfully.');
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


    public function export_excel()
    {
        $data = RegistrationModels::with(['student', 'toeicTest'])
            ->where('status', 'active') // hanya ambil yang status-nya "approve"
            ->orderBy('registration_date', 'desc')
            ->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'NIM');
        $sheet->setCellValue('C1', 'Name');
        $sheet->setCellValue('D1', 'Test Date');
        $sheet->setCellValue('E1', 'Register Date');
        $sheet->setCellValue('F1', 'Status');

        $sheet->getStyle('A1:F1')->getFont()->setBold(true);

        // Data
        $no = 1;
        $baris = 2;
        foreach ($data as $value) {
            $sheet->setCellValue('A' . $baris, $no);
            $sheet->setCellValue('B' . $baris, $value->student->NIM ?? '-');
            $sheet->setCellValue('C' . $baris, $value->student->user->name ?? '-');
            $sheet->setCellValue('D' . $baris, $value->toeicTest->date ?? '-');
            $sheet->setCellValue('E' . $baris, $value->registration_date);
            $sheet->setCellValue('F' . $baris, $value->status);
            $baris++;
            $no++;
        }

        foreach (range('A', 'F') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $sheet->setTitle('Data Pendaftaran TOEIC');
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data_Pendaftaran_TOEIC_' . date('Ymd_His') . '.xlsx';

        // Headers
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header('Cache-Control: max-age=0');
        header('Expires: 0');
        header('Pragma: public');

        $writer->save('php://output');
        exit;
    }

    // nah ini ambil dari data studentnya kan dari stundet model berarti bisa yak
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
    { {
            // Validate the incoming data
            $request->validate([
                'student_id' => 'required|exists:students,id',
                'toeic_test_id' => 'required|exists:toeic_tests,id',
                'registration_date' => 'required|date',
                'status' => 'required|in:pending,active,inactive',
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

            // Try to create the registration record
            try {
                RegistrationModels::create([
                    'student_id' => $request->student_id,
                    'toeic_test_id' => $request->toeic_test_id,
                    'registration_date' => $request->registration_date,
                    'status' => $request->status,
                ]);
            } catch (QueryException $e) {
                // Cek error code PostgreSQL: 23505 = unique violation
                if ($e->getCode() == '23505') {
                    return redirect()->back()->with('error', 'Student is already registered. Please check again.');
                }

                // Error lain (fallback)
                return redirect()->back()->with('error', 'An error occurred while registering. Please try again.');
            }

            // Redirect success
            return redirect()->route('registration.index')->with('success', 'Registration created successfully.');
        }
    }
}



