<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserModels extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = true; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'google_token',
        'google_refresh_token',
        'email_verified_at',
        'role_id', 
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'google_token',
        'google_refresh_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }

    /**
     * Get the role of the user.
     *
     * @return string
     */
    public function getRole(): string
    {
        // Mengambil nama role dari relasi role
        return $this->roleRelation->name ?? 'mahasiswa'; // Default role if not set
    }

    /**
     * Relationship to the RoleModels.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function roleRelation()
    {
        return $this->belongsTo(RoleModels::class, 'role_id');
    }

    /**
     * Check if the user has a specific role.
     *
     * @param string $role
     * @return bool
     */
    public function role(string $role): bool
    {
        return $this->roleRelation->name === $role;
    }
}
