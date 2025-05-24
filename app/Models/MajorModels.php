<?php

namespace App\Models;

use App\Models\StudentModels;
use App\Models\StudyProgramModels;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MajorModels extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'majors';
        protected $primaryKey = 'id';
        public $timestamps = true;

    protected $fillable = [
        'study_program_id',
        'major_name'
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