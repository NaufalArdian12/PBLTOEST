<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StudentModels;
use App\Models\ToeicTestModels;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegistrationModels extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'registrations';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'student_id',
        'registration_date',
        'status',
    ];

    // Relationships
    public function student()
    {
        return $this->belongsTo(StudentModels::class, 'student_id');
    }

    public function toeicTest()
    {
        return $this->hasMany(ToeicTestModels::class);
    }
}
