<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentModels extends Model
{
    use HasFactory, SoftDeletes;

    
    protected $fillable = [
        'user_id',
        'NIM',
        'NIK',
        'study_program_id',
        'major_id',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(UserModels::class);
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
