<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationModels extends Model
{
    use HasFactory;

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
