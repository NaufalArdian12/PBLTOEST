<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Traits\Timestamp;

class MajorModels extends Model
{
    use HasFactory, SoftDeletes, Timestamp;

    protected $fillable = [
        'major_name',
    ];

    // Relationships
    public function studyProgram()
    {
        return $this->belongsTo(StudyProgramModels::class);
    }

    public function students()
    {
        return $this->hasMany(StudentModels::class);
    }
}
