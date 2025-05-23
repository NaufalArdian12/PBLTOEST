<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StudyProgramModels;
use App\Models\StudentModels;
use Illuminate\Database\Eloquent\SoftDeletes;

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
