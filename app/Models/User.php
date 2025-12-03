<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Models\Traits\BelongsToEmpresa;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use BelongsToEmpresa;

    protected $fillable = [
        'nome',
        'email',
        'auth0_id',
        'tenant_id',
        'avatar',
        'role',
        
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_users');
    }

    public function hasRole($roleName)
    {
        return $this->roles()->where('name', $roleName)->exists();
    }
}
