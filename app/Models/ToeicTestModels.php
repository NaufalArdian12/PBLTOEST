<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AdminModels;
use App\Models\RegistrationModels;
use App\Models\StudentModels;
use App\Models\EducationalStaffModels;
use Illuminate\Database\Eloquent\SoftDeletes;

class ToeicTestModels extends Model
{
    use HasFactory, SoftDeletes;

        protected $table = 'toeic_tests';
        protected $primaryKey = 'id';
        public $timestamps = true;

    protected $fillable = [
        'admin_id',
        'date',
        'zoom_link',
        'max_participants',
    ];

    // Relationships
    public function admin()
    {
        return $this->belongsTo(AdminModels::class);
    }
    public function registrations()
    {
        return $this->hasMany(RegistrationModels::class, 'toeic_test_id');
    }

}
