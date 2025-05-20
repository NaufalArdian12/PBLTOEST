<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentModels extends Model
{
    use HasFactory;

    protected $fillable = [
        'NIM',
        'NIK',
        'study_program_id',
        'major_id',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function studyProgram()
    {
        return $this->belongsTo(StudyProgramModels::class, 'study_program_id');
    }

    public function major()
    {
        return $this->belongsTo(MajorModels::class, 'major_id');
    }

    public function registrations()
    {
        return $this->hasMany(RegistrationModels::class, 'NIM');
    }
}
