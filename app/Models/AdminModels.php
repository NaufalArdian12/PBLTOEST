<?php

namespace App\Models;

use App\Models\UserModels;
use App\Models\ToeicTestModels;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminModels extends Model
{
    use HasFactory, SoftDeletes ;

    protected $table = 'admins';
    protected $primaryKey = 'id';
    public $timestamps = true;

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
