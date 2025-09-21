<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserModels;
use Illuminate\Database\Eloquent\SoftDeletes;

class EducationalStaffModels extends Model
{
    use HasFactory, SoftDeletes;

        protected $table = 'educational_staff';
        protected $primaryKey = 'id';
        public $timestamps = true;

    protected $fillable = [
        'NIP',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(UserModels::class);
    }
}
