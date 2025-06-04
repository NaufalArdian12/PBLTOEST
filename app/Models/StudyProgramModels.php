<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StudentModels;
use App\Models\MajorModels;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudyProgramModels extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'study_programs';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'study_program_name',
        'major_id',
        'campus_id',
    ];

    // Relationships
    public function major()
    {
        return $this->belongsTo(MajorModels::class, 'major_id');
    }

    public function students()
    {
        return $this->hasMany(StudentModels::class, 'study_program_id');
    }

    public function campus()
    {
        return $this->belongsTo(CampusModels::class, 'campus_id');
    }
}
