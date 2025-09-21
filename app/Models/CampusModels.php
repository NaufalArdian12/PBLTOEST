<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CampusModels extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'campuses';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'campus_name',
    ];

    // Relationships
      public function majors()
    {
        return $this->hasMany(MajorModels::class, 'campus_id');
    }
}
