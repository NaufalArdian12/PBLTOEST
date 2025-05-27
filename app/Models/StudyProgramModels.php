<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MajorModels;
use App\Models\CampusModels;
use App\Models\StudentModels;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudyProgramModels extends Model
{
    use HasFactory, SoftDeletes;

        protected $table = 'study_programs';
        protected $primaryKey = 'id';
        public $timestamps = true;

    protected $fillable = [
        'study_program_name',
        'campus_id',
        'major_id'
    ];

    // Relationships
    public function majors()
    {
        return $this->belongsTo(MajorModels::class, 'major_id');
    }

        public function campus()
    {
        return $this->belongsTo(CampusModels::class, 'campus_id');
    }


    public function students()
    {
        return $this->hasMany(StudentModels::class, 'student_id');
    }
}