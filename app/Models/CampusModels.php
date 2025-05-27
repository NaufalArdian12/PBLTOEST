<?php

namespace App\Models;

use App\Models\StudyProgramModels;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CampusModels extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'campuses';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'campus_name'
    ];

    // Relationships
      public function majors()
    {
        return $this->hasMany(MajorModels::class, 'campus_id');
    }
      public function study_program()
    {
        return $this->hasMany(StudyProgramModels::class, 'study_program_id');
    }
}