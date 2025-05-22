<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegistrationModels extends Model
{
    use HasFactory, SoftDeletes;

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
