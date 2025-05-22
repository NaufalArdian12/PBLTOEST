<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudyProgramModels extends Model
{
    use HasFactory, SoftDeletes, Timestamp;

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
