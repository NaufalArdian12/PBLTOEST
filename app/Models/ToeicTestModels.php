<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\SoftDeletes;

class ToeicTestModels extends Model
{
    use HasFactory, SoftDeletes;
        protected $table = 'toeic_tests';
        protected $primaryKey = 'id';
        public $timestamps = true;

    protected $fillable = [
=======

class ToeicTestModels extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_id',
>>>>>>> e1253e9b29705f0ebb0ce30325b8a5a93925a030
        'admin_id',
        'registration_id',
        'NIM',
        'NIP',
        'date',
        'zoom_link',
        'max_participants',
    ];

    // Relationships
    public function admin()
    {
        return $this->belongsTo(AdminModels::class);
    }

    public function registration()
    {
        return $this->belongsTo(RegistrationModels::class);
    }

    public function student()
    {
        return $this->belongsTo(StudentModels::class, 'NIM');
    }

    public function educationalStaff()
    {
        return $this->belongsTo(EducationalStaffModels::class, 'NIP');
    }
}
