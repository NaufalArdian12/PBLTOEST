<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
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
=======

class MajorModels extends Model
{
    use HasFactory;

    protected $fillable = [
        'major_name',
>>>>>>> e1253e9b29705f0ebb0ce30325b8a5a93925a030
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
