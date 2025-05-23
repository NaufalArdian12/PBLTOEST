<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserModels;
use App\Models\StudyProgramModels;
use App\Models\MajorModels;
use App\Models\RegistrationModels;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentModels extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'students';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'NIM',
        'NIK',
        'study_program_id',
        'major_id',
        'scan_ktp',
        'scan_ktm',
        'pas_photo',
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
