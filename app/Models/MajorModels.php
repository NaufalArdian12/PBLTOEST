<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\StudyProgramModels;
use Illuminate\Database\Eloquent\SoftDeletes;

class MajorModels extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'majors';
        protected $primaryKey = 'id';
        public $timestamps = true;

    protected $fillable = [
        'major_name',
        'campus_id',
    ];

    // Relationships
    public function studyProgram()
    {
        return $this->hasMany(StudyProgramModels::class, 'major_id');
    }

   public function campus()
    {
        return $this->belongsTo(CampusModels::class, 'campus_id');
    }
}
