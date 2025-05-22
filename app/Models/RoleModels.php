<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleModels extends Model
{
    use HasFactory;

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
