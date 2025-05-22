<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminModels extends Model
{
    use HasFactory, SoftDeletes;

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
