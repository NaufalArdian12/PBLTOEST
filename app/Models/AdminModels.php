<?php

namespace app\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\UserModels;
use app\Models\ToeicTestModels;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminModels extends Model
{

    use HasFactory, SoftDeletes;

    protected $table = 'admins';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
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
