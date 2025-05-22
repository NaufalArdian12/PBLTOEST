<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyProgramModels extends Model
{
    use HasFactory;

    protected $fillable = [
        'study_program_name',
    ];

    // Relationships
    public function students()
    {
        return $this->hasMany(StudentModels::class);
    }

    public function majors()
    {
        return $this->hasMany(MajorModels::class);
    }
}
