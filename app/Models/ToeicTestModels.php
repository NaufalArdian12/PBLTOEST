<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToeicTestModels extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_id',
        'admin_id',
        'registration_id',
        'NIM',
        'NIP',
        'date',
        'zoom_link',
        'max_participants',
    ];

    // Relationships
    public function admin()
    {
        return $this->belongsTo(AdminModels::class);
    }

    public function registration()
    {
        return $this->belongsTo(RegistrationModels::class);
    }

    public function student()
    {
        return $this->belongsTo(StudentModels::class, 'NIM');
    }

    public function educationalStaff()
    {
        return $this->belongsTo(EducationalStaffModels::class, 'NIP');
    }
}
