<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoleModels extends Model
{
    use HasFactory, SoftDeletes;

    // Tentukan nama tabel jika tidak mengikuti konvensi Laravel
    protected $table = 'roles';

    // Tentukan kolom-kolom yang dapat diisi
    protected $fillable = ['name'];

    // Tentukan relasi antara Role dan User
    public function users()
    {
        return $this->hasMany(UserModels::class, 'role_id');
    }
}
