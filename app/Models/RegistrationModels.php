<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\SoftDeletes;

class RegistrationModels extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'registrations';
    protected $primaryKey = 'id';
    public $timestamps = true;
=======

class RegistrationModels extends Model
{
    use HasFactory;
>>>>>>> e1253e9b29705f0ebb0ce30325b8a5a93925a030

    protected $fillable = [
        'NIM',
        'registration_date',
        'status',
    ];

    // Relationships
    public function student()
    {
        return $this->belongsTo(StudentModels::class, 'NIM');
    }

    public function toeicTest()
    {
        return $this->hasMany(ToeicTestModels::class);
    }
}
