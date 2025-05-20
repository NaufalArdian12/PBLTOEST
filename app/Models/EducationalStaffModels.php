<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalStaffModels extends Model
{
    use HasFactory;

    protected $fillable = [
        'NIP',
        'lecturer_name',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
