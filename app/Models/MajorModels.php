<?php

namespace App\Models;

use App\Models\StudentModels;
use App\Models\CampusModels;
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
        'campus_id',
        'major_name',
        'study_program_id'
    ];

    // Relationships
    public function campus()
    {
        return $this->belongsTo(CampusModels::class, 'campus_id');
    }

    public function students()
    {
        return $this->hasMany(StudentModels::class);
    }
}