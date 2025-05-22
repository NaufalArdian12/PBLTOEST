<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\SoftDeletes;

class StudyProgramModels extends Model
{
    use HasFactory, SoftDeletes;

        protected $table = 'study_programs';
        protected $primaryKey = 'id';
        public $timestamps = true;

    protected $fillable = [
        'study_program_name',
        ''
=======

class StudyProgramModels extends Model
{
    use HasFactory;

    protected $fillable = [
        'study_program_name',
>>>>>>> e1253e9b29705f0ebb0ce30325b8a5a93925a030
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
