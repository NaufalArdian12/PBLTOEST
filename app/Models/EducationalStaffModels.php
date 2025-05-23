<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\SoftDeletes;

class EducationalStaffModels extends Model
{
    use HasFactory, SoftDeletes;

        protected $table = 'educational_staff';
        protected $primaryKey = 'id';
        public $timestamps = true;
=======

class EducationalStaffModels extends Model
{
    use HasFactory;
>>>>>>> e1253e9b29705f0ebb0ce30325b8a5a93925a030

    protected $fillable = [
        'NIP',
        'lecturer_name',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(UserModels::class);
    }
}
