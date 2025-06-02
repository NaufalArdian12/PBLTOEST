<?php
namespace App\Http\Controllers\Admin;

use App\Models\Registration;
use App\Models\RegistrationModels;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegistrationApprovalController extends Controller
{
    // Method untuk Approve
    public function approve($id)
    {
        $registration = RegistrationModels::findOrFail($id);
        $registration->status = 'active';
        $registration->save();

        return redirect()->route('admin.dashboard')->with('success', 'Registration approved successfully.');
    }

    // Method untuk Reject
    public function reject($id)
    {
        $registration = RegistrationModels::findOrFail($id);
        $registration->status = 'inactive';  // Mengubah status menjadi rejected
        $registration->save();

        return redirect()->route('admin.dashboard')->with('success', 'Registration rejected successfully.');
    }
}
