<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\StudentModels;
use app\Models\ToeicTestModels;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegistrationModels extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'registrations';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'student_id',
        'toeic_test_id',
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
        return $this->belongsTo(ToeicTestModels::class);
    }
}
