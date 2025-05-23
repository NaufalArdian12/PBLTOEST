<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentModels extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'students';
    protected $primaryKey = 'id';
    public $timestamps = true;
=======

class StudentModels extends Model
{
    use HasFactory;
>>>>>>> e1253e9b29705f0ebb0ce30325b8a5a93925a030

    protected $fillable = [
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
