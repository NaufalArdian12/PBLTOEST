<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminModels extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_name',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(UserModels::class);
    }

    public function toeicTests()
    {
        return $this->hasMany(ToeicTestModels::class, 'admin_id');
    }
}
