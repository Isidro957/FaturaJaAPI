<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
#use App\Models\Role;
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id_area',
        'name',
        'profile_photo_path',
        'email',
        'password',
        'condicao_user',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];

    }

    public function roles(){

      return $this->belongsToMany(Role::class,'role__users');
    }

    public function hasAccess(array $permissions)
    {
      foreach ($this->roles as $role) {
      if ($role->hasAccess($permissions)) {
      return true;
      }

      }

        return false;
    }

    public function inRole($roleSlug)
    {

        return $this->roles()->where('slug',$roleSlug)->count()==1;
    }
}
